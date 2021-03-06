<?php
$questionArray = Question::getAllQuestions();
$thematics = Question::getAllThematics();
?>

<form method="post" id="_qcm_form" class="mb-5">
  <div class="form-group row">
    <label class="col-sm-3 col-form-label text-right">Titre du QCM</label>
    <div class="col-sm-9">
      <input class="form-control" name="qcm_title" required>
    </div>
  </div>
  <div class="container" id="researchBlock">
    <div class="input-group mb-5 mt-5 d-flex justify-content-center">
      <label class="col-sm-3 col-form-label text-right">Rechercher des questions:</label>
      <div class="col-sm-3">
        <select class="form-control mr-5" title="theme" name="select_theme1" id="select_thematics" required>
          <option value="all" selected>Tous</option>
          <?php
          foreach ($thematics as $thematic) {
            echo "<option value='$thematic'>$thematic</option>";
          }
          ?>
        </select>
      </div>
    </div>
  </div>

  <div class="container mb-5">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Thème</th>
          <th scope="col">Intitulé de la question</th>
          <th scope="col">Question(s) ajoutée(s)</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody id="block_questions_list">
        <?php
        foreach ($questionArray as $q) {
          $responses = $q->getResponses();
          $author = Question::getAuthor($q->getIdTeacher());
          $authorName = $author[0]->prenom." ".$author[0]->nom;

          //On JSONise le tableau pour qu'il soit passable à la modal via la JS
          $responsesJson = json_encode($responses);
          echo "<tr class='{$q->getTheme()} tr_theme'>
          <td scope='row' class='col-auto'>
          {$q->getTheme()}
          </td>
          <td scope='row' class='col-sm-9'>
          {$q->content}
          </td>
          <td scope='row' class='form-check'>
          <input class='questions' type='checkbox' name='add_question[]' value='{$q->getIdQuestion()}'>
          </td>
          <td scope='row'>
          <button type='button' class='btn btn-info btn-sm modal_question' data-toggle='modal' data-target='#_question_modal' data-id='{$q->getIdQuestion()}' data-title='{$q->content}' data-id_teacher='{$q->getIdTeacher()}' data-theme='{$q->getTheme()}' data-author_name='$authorName' data-responses='$responsesJson'>
          consulter
          </button>";
          "</td>
          </tr>";
          include('modals/_question_modal.php');

        }

        ?>

      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col-12">
      <label>A rendre avant le : <input type="date" name="date_limit_qcm" required></label>
    </div>
  </div>
  <div class="d-flex justify-content-center">
    <input type="submit" value="envoyer" class="btn btn-success btn-lg mt-5 mr-5" name="submitQCM">
  </div>
  <?php
  ?>
</form>
<script>
$(document).ready(function () {
  displayErrorQcm();
  displayByThematics();

  //pour afficher une question et ses réponses associées
  $('.modal_question').on('click', function () {
    // au clic, on charge toutes les données en data-attribute
    let questionId = $(this).data('id');
    let teacher_fullName = $(this).data('author_name');
    let questionTheme = $(this).data('theme');
    let responsesJSONArray = $(this).data('responses');
    let questionTitle = $(this).data('title');
    let html = '';
    let responsesIdArray = [];
    //à partir d'un tableau json, pour chaque index de réponse (clé), on affiche l'intitulé de la réponse correspondante (valeur)
    responsesJSONArray.forEach(function (e, answerIndex) {
      let is_correct = e.is_correct == 1 ? '✅' : '';
      // console.log("idQuestion:" + questionId + "idResponse" + answerIndex + ": "+ e.id_response);

      switch (answerIndex){
        case 0:
        answerIndex = 'A.';
        break;
        case 1:
        answerIndex = 'B.';
        break;
        case 2:
        answerIndex = 'C.';
        break;
        case 3:
        answerIndex = 'D.';
        break;
        default:
        break;
      }
      responsesIdArray.push(e.id_response);

      html += "<tr ><th scope='row'>" +
      answerIndex +
      "</th><th scope='row' class='col-sm-8'>" +
      e.response +
      "</th><th scope='row' class='form-check'>"+is_correct+"</th></tr>"
    });
    $('#question_label_modal').html('Question #' + questionId);
    $('#question_teacher_modal').html(teacher_fullName);
    $('#question_content_modal').html(questionTitle);
    $('#question_theme_modal').html(questionTheme);
    $('#table-response').html(html);
    console.log("json:" + JSON.stringify(responsesIdArray));

    $.get("dashboard.php",{idQuestion: questionId});

  });

  $('#select_thematics').on('change', function () {
    $('#form_search_thematics').submit();
  })

  //pour modifier une question et ses réponses associées
  //au clic, on remplace les éléments affichant la question et les réponses par des champs textuels contenant les valeurs de la question des réponses associées
  $('#modifyBtn').on('click', function () {
    replaceBlocWithForm();
    replaceQuestionTitleWithTextArea();
    replaceReponseTitleWithInput();
    replaceCellWithCheckboxInput();
    whenClickOnModifyBtn_replaceModifyBtnWithQuitBtn();
    whenClickOnInput_appendSubmitBtn();

    //au clic sur le bouton submit, envoi du titre de la question vers la page cible dashboard.php pour récupération puis insertion dans la base de données
    $('#form_modify_question').on('submit', function () {
      let newQuestionTitle = $('#modify_question_title_input').val();
      $.get("dashboard.php", {content_modify_question: newQuestionTitle});

    })
  })
});

function displayByThematics() {
  var select = $('#select_thematics');
  var theme = $('.tr_theme');
  select.on('change', function () {
    var selected = $('#select_thematics option:selected').text();
    $('.tr_theme').removeClass('d-none');
    theme.each(function (i, b) {
      var content_class = $(this).attr('class');
      if (selected == "Tous") {
        $(this).removeClass('d-none');
      } else if (!(content_class.includes(selected))) {
        $(this).addClass('d-none');
      }
    });

  })
}

function displayErrorQcm() {
  $('#_qcm_form').submit(function (e) {
    if ($('.questions:checkbox:checked').length < 1) {
      e.preventDefault();
      alert('Veuillez séléctionnez au moins une question à ajouter au QCM !');
    }
  });
}

function replaceBlocWithForm() {
  //le bloc contenant l'affichage de la question/des réponses est remplacé par un formulaire
  $('.modal-content').replaceWith("<form class='modal-content' action='' method='post' id='form_modify_question'>" + $('.modal-content').html() + "</form>");
}

function replaceQuestionTitleWithTextArea() {
  let titreDelaQuestion =  $('#question_content_modal').text();
  //le bloc contenant le titre de la question est remplacé par un textarea
  let blocTitreDelaQuestion = $('#question_content_modal');
  blocTitreDelaQuestion.replaceWith('<textarea class="form-control col-sm-11 mb-5 mx-auto" type="text" rows="2" id="modify_question_title_input">');
  //affiche titre de la question en placeholder dans le textarea
  $('textarea').attr('placeholder',titreDelaQuestion);
}

function replaceReponseTitleWithInput() {
  let tableauTitresDesReponses = new Array();
  let ligneDuTableauDesReponses = $('#table-response').find('tr');
  ligneDuTableauDesReponses.each(function (index) {
    tableauTitresDesReponses[index] = $('#table-response').find('tr:nth-child(' + (index+1) + ') > th:nth-child(2)').text();
  })
  //remplace titre de la réponse par un input
  let contenuLigneTableauDesReponses = $('#table-response').find('th.col-sm-8');
  contenuLigneTableauDesReponses.html('<input class="form-control col-sm-11" value="" type="text" name="">');
  //affiche titre de la réponse en placeholder dans l'input + attribut name unique pour différencier les réponses
  let nouvelInputTableauDesReponses = $('#table-response').find('input');
  nouvelInputTableauDesReponses.each(function(numeroDeLigneTableauReponses){
    this.name = 'response_title_' + (numeroDeLigneTableauReponses+1) ;
    this.value = tableauTitresDesReponses[numeroDeLigneTableauReponses];
  });
}

function replaceCellWithCheckboxInput() {
  //remplace l'affichage des bonnes réponses par des input pour modifier les bonnes réponses
  let checkboxReponse = $('#table-response').find('th.form-check');
  checkboxReponse.html('<input name="" type="checkbox">');
  //attribut name unique pour différencier les checkbox
  let checkboxDansTableauDesReponses = $('#table-response').find('[type="checkbox"]');
  checkboxDansTableauDesReponses.each(function(index){
    this.name = 'response_cb_' + (index+1) ;
  });
}

function whenClickOnModifyBtn_replaceModifyBtnWithQuitBtn() {
  $('#modifyBtn').replaceWith('<button type="button" id="quitBtn" class="btn btn-danger mr-3">Quitter</button>');
  $('#quitBtn').on('click', function () {
    location.reload();
  })
}

function whenClickOnInput_appendSubmitBtn() {
  //au clic sur un champ du formulaire, un bouton submit est ajouté au DOM
  let formInput = $('#form_modify_question').find($('.form-control'));
  formInput.bind('click', function f() {
    $('.modal-footer').append('<button type="submit"  name="submitSetQuestion" class="btn btn-success" >Envoyer</button>');
    $('.form-control').unbind('click', f);
  });
}
</script>
