<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="assets/js/index.js"></script>
  </head>
  <body>
    <form id="new_question_form" class="mb-5" method="post">
      <h2 class="col-sm-3 mb-5">En-tête</h2>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label text-right">Titre du QCM</label>
        <div class="col-sm-9">
          <input  class="form-control" name="qcm_title" >
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-outline-primary mt-5" name="btn_add_questions">Ajouter des questions</button>
      </div>
      <div id="block_questions_list" class="container mb-5 d-none" >
        <h2 class="col-sm-6 mt-5 mb-5">Sélection des questions à retenir</h2>
        <div class="container" id="researchBlock" >
          <hr class= "mb-3 mt-2">
          <h4 class="col-sm-7 mt-5">Rechercher des questions par thème: </h4>
          <div class="input-group mb-5 mt-5 d-flex justify-content-center">
            <label class="col-sm-3 col-form-label text-right">Thème de la question</label>
            <div class="col-sm-3">
              <select class="form-control mr-5" title="theme" name="select_theme1" required>
                <option  disabled selected>choisir un thème</option>
                <option value="0">Programmation web</option>
                <option value="1">Réseau</option>
              </select>
            </div>
            <input type="text" class="form-control col-sm-3 ml-5" placeholder="Rechercher" aria-label="rechercher" aria-describedby="button-addon2">
            <div class="input-group-append">
              <button class="btn btn-outline-info" type="button" id="button-addon21">OK</button>
            </div>
        </div>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Thème</th>
              <th scope="col">Intitulé de la question</th>
              <th scope="col">Question(s) ajoutée(s)</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" class="col-sm-3">
                Programmation web
              </th>
              <th scope="row" class="col-sm-9">
                Quelle fonction retourne le nombre de secondes écoulées depuis le 1er janvier 1970 ?  </div>
              </th>
              <th scope="row" class="form-check">
                <input type="checkbox" name="" >
              </th>
              <th scope="row" >
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#questionModal">
                  consulter
                </button>

                <!-- Modal -->
                <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Consultation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php require("_questionDisplayTeacher.php"); ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </th>
            </tr>
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-outline-success btn-lg mt-5 mr-5" name="submitQCM">Envoyer</button>
          <button type="button" class="btn btn-info btn-lg mt-5" name="previewQCM" data-toggle="modal" data-target="#previewModal">Aperçu</button>
        </div>
        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aperçu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" >Publier</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
