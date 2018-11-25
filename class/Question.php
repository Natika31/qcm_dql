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
        echo $this->id_question;
        $cnx->prepareAndExecute($query,array('id_question' => $this->id_question,
                                            'id_teacher' => $_SESSION['id_user'],
                                            'theme' => $this->theme,
                                            'content' => $this->title));
        return true;
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
