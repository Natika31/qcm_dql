<?php

class Question {
    private $_id_question;
    private $_id_teacher;
    private $_theme;
    private $_title;

    public function __construct($id_question = null, $id_teacher = null, $theme = null, $title = null)
    {
        $this->setIdQuestion($id_question);
        $this->setIdTeacher($id_teacher);
        $this->setTheme($theme);
        $this->setTitle($title);
    }

    public function idQuestion()
    {
      return $this->_id_question;
    }

    public function setIdQuestion($id_question)
    {
      $this->_id_question = (int) $id_question;
    }

    public function idTeacher()
    {
      return $this->_id_teacher;
    }

    public function setIdTeacher($id_teacher)
    {
      $this->_id_teacher = (int) $id_teacher;
    }

    public function theme()
    {
      return $this->_theme;
    }

    public function setTheme($theme)
    {
      if (is_string($theme) && strlen($theme) <= 255) {
        $this->_theme = $theme;
      }
    }

    public function title()
    {
      return $this->_title;
    }

    public function getTitle()
    {
      require 'Connexion.php';
      $cnx = Connexion::getInstance();
      $req = "SELECT title from question where $id_question = 1";

      return $cnx->xeq($req)->nb();
    }

    public function setTitle($title)
    {
      if (is_string($title) && strlen($title) <= 255) {
        $this->_title = $title;
      }
    }

    public function addQuestion()
    {
        $cnx = Connexion::getInstance();

        $req = "INSERT INTO questions VALUES(DEFAULT, {$_SESSION['id_user']}, {$cnx->esc($this->theme())}, {$cnx->esc($this->title())})";
        $cnx->xeq($req);

        return true;
    }

  }
