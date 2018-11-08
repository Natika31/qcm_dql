<!DOCTYPE html>
<html>
    <head>
        <?php require_once 'head.php' ?>
        <script src="assets/js/newQCM.js"></script>
    </head>
    <body>
      <div class="container mt-5" >
        <div >
          <button type="button" id="btn_buildQCM" class="btn btn-outline-primary btn-lg btn-block mb-5">Construire un QCM</button>
        </div>
        <div id="block_buildNewQCM" class="container mb-5" >
          <?php require('_QCMbuilding.php'); ?>
        </div>
        <div >
          <button type="button" id="btn_new_question" class="btn btn-outline-primary btn-lg btn-block mb-5">Déposer une question</button>
        </div>
        <div id="block_newQuestion" class="container mb-2 d-none" >
          <?php require('_newQuestion.php'); ?>
        </div>

        </div>
      </div>
    </body>
</html>
