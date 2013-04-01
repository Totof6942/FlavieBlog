<?php

class Form
{
    /**
     * @var Controller
     */
    private $controller;

    /**
     * @var array
     */
    private $errors;

    /**
     * Constructeur
     *
     * @param Controller $controller
     */
    public function __construct($controller)
    {
        $this->controller = $controller;
    }

    /**
     * Set $errors
     *
     * @param array $errors
     */
    public function setErrors($errors = array())
    {
        $this->errors = $errors;
    }

    /**
      * Permet de construire un input
      *
      * @param string $name    Nom du l'input (doit correspondre au champ de la table visée)
      * @param string $label   Texte à afficher dans le label
      * @param array  $options Array des options (class, placeholder, type, etc...)
      *
      * @return string Retourne le code html
      */
    public function input($name, $label, $options = array())
    {
        $error = false;
        $classError = '';
        $html = '';

        if (isset($this->errors[$name])) {
            $error = $this->errors[$name];
            $classError = ' error';
        }

        if (!isset($this->controller->getRequest()->getData()->$name)) {
            $value = '';
        } else {
            $value = $this->controller->getRequest()->getData()->$name;
        }

        if ($label == 'hidden') {
            return '<input type="hidden" name="'.$name.'" value="'.$value.'">';
        }

        $html .= '<div class="control-group'.$classError.'">';
        $html .= '<label class="control-label" for="input'.$name.'">'.$label.' :</label>';
        $html .= '<div class="controls">';
        $attr = ' ';


        foreach ($options as $key => $v) {
            if ('type' !== $key && 'options' !== $key) {
                $attr .= "$key=\"$v\" ";
            }
        }

        if (!isset($options['type']) && !isset($options['options'])) {
            $html .= '<input type="text" id="input'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.'>';
        } elseif (isset($options['options'])) {
            $html .= '<select id="input'.$name.'" name="'.$name.'">';

            foreach ($options['options'] as $k=>$v) {
                $html .= '<option value="'.$k.'" '.($k==$value?'selected':'').'>'.$v.'</option>';
            }

            $html .= '</select>';
        } elseif ($options['type'] == 'password') {
            $html .= '<input type="password" id="input'.$name.'" name="'.$name.'" value="'.$value.'" '.$attr.'>';
        } elseif ($options['type'] == 'textarea') {
            $html .= '<textarea id="input'.$name.'" name="'.$name.'" '.$attr.'>'.$value.'</textarea>';
        } elseif ($options['type'] == 'checkbox') {
            $html .= '<input type="hidden" name="'.$name.'" value="0">
                      <input type="checkbox" name="'.$name.'" value="1" id="input'.$name.'" '.(empty($value)?'':'checked').' '.$attr.'>';
        } elseif ($options['type'] == 'file') {
            $html .= '<input type="file" id="input'.$name.'" name="'.$name.'"'.$attr.'>';
        }

        if ($error) {
            $html .= '<span class="help-block">'.$error.'</span>';
        }

        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }
}
