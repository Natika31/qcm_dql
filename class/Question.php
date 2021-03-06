<?php

class Question {
    private $id_question;
    private $id_teacher;
    private $theme;
    private $title;

    public function __construct($id_question = null, $id_teacher = null, $theme = null, $title = null)
    {
        $this->id_question = $id_question;
        $this->id_teacher = $id_teacher;
        $this->theme = $theme;
        $this->title = $title;
    }

    public function addQuestion()
    {
        $cnx = Connexion::getInstance();

        $query = "INSERT INTO questions VALUES(:id_question, :id_teacher, :theme, :content)";
        $cnx->prepareAndExecute($query,array('id_question' => $this->id_question,
                                             'id_teacher'  => $_SESSION['id_user'],
                                             'theme'       => $this->theme,
                                             'content'     => $this->title));
        return true;
    }

    public static function updateQuestion($id, $titleparam)
    {
        $cnx = Connexion::getInstance();

        $query = "UPDATE questions SET content = :title WHERE id_question = :id";
        $cnx->prepareAndExecute($query,array('title' => $titleparam, 'id' => $id));
        return true;
    }

    public static function getAllThematics()
    {
        $cnx = Connexion::getInstance();
        $query = "SELECT theme FROM questions";
        $q = $cnx->prepareAndExecute($query);
        $result = $q->tab();
        $tab = [];

        foreach($result as $r){
            $tab[] = $r->theme;
        }

        $tab = array_unique($tab);

        return $tab;
    }

    public static function getAllQuestions()
    {
        $cnx = Connexion::getInstance();

        $query = "SELECT * FROM questions";

        $q = $cnx->prepareAndExecute($query);

        return $q->tab(Question::class);
    }

    public function getResponses()
    {
        $cnx = Connexion::getInstance();
        $req = "SELECT * FROM response WHERE id_question = :id_question";

        return $cnx->prepareAndExecute($req, ['id_question' => $this->id_question])->tab();
    }

    public static function getIdResponsesWithIdQuestion($id_question)
    {
        $cnx = Connexion::getInstance();
        $req = "SELECT id_response FROM response WHERE id_question = :id_question AND is_correct = 1";

        return $cnx->prepareAndExecute($req, ['id_question' => $id_question])->tab();
    }

    public static function getAuthor($id_author)
    {
        $cnx = Connexion::getInstance();

        $req = "SELECT prenom, nom FROM user WHERE id_user = :id_author";

        $result = $cnx->prepareAndExecute($req, ['id_author' => $id_author])->tab();

        return $result;
    }

    public static function countNbCorrectQuestion($id_question)
    {
        $cnx = Connexion::getInstance();

        $req = "SELECT * FROM response WHERE id_question = :id_question AND is_correct = 1";

        $result = $cnx->prepareAndExecute(
            $req,
            [
                'id_question' => $id_question,
            ]
        );

        return $result->rowNb();
    }

    /**
     * @return null
     */
    public function getIdQuestion()
    {
        return $this->id_question;
    }

    /**
     * @param null $id_question
     */
    public function setIdQuestion($id_question): void
    {
        $this->id_question = $id_question;
    }

    /**
     * @return null
     */
    public function getIdTeacher()
    {
        return $this->id_teacher;
    }

    /**
     * @param null $id_teacher
     */
    public function setIdTeacher($id_teacher): void
    {
        $this->id_teacher = $id_teacher;
    }

    /**
     * @return null
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param null $theme
     */
    public function setTheme($theme): void
    {
        $this->theme = $theme;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }


}
