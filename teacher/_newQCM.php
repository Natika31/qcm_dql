<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require_once 'head.php' ?>
    <script src="assets/js/newQCM.js"></script>
  </head>
  <body>
    <form id="new_question_form" class="container mb-5" method="post">
        <h2 class="col-sm-3 mb-5">En-tête</h2>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">Titre du QCM</label>
          <div class="col-sm-9">
            <input  class="form-control" name="qcm_title" >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label text-right">Date limite</label>
          <div class="col-sm-2">
            <input class="form-control" name="qcm_deadline" placeholder="XX/XX/XXXX" required>
          </div>
        </div>
        <div class="d-flex justify-content-center">
          <button type="button" class="btn btn-outline-info mt-5" name="btn_add_questions">Ajouter une question</button>
        </div>
        <div id="block_questions_list" class="container mb-5 d-none" >
          <h3 class="col-sm-6 mt-5 mb-5">Sélection des questions à retenir</h3>
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
                    theme
                  </th>
                  <th scope="row" class="col-sm-8">
                    titre de la question
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
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Question #</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?php require("_questionDisplay.php"); ?>
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
            <button type="submit" class="btn btn-outline-success btn-lg mt-5" name="submitQCM">Envoyer</button>
          </div>
        </div>
    </form>
  </body>
</html>
