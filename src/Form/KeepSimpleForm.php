<?php

namespace Drupal\congenial_happiness\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * This form keeps it simple. It has a single text input element. I am extending
 * the FormBase which is the simplest form base class used in Drupal.
 */

class KeepSimpleForm extends FormBase
{

    /**
     * @inheritDoc
     */
    public function getFormId()
    {
        return 'congenial_happiness_keep_it_simple_form';
    }

    /**
     * @inheritDoc
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form['description'] = [
          '#type' => 'item',
          '#markup' => $this->t('This keeps it simple with a single text input element and submit button')
        ];

        $form['title'] = [
          '#type' => 'textfield',
          '#title' => $this->t('Title'),
          '#description' => $this->t('The title must be between 5 and 9 characters long and all lowercase'),
          '#required' => TRUE,
        ];

        // Submit handlers are grouped in an actions element with a key of "actions"
        // so that it gets styled correctly, and so that other modules may add actions
        // to the form.
        $form['actions']['submit'] = [
          '#type' => 'submit',
          '#value' => $this->t('Submit'),
        ];

        return $form;
    }

  /**
   * Implements form validation.
   *
   * @param array $form
   *  The render array of the currently built form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *  Object describing the current state of the form.
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    $title = $form_state->getValue('title');
    if (strlen($title) < 5 || strlen($title) > 9) {
      // Set an error for the form element with a key of "title".
      $form_state->setErrorByName('title', $this->t('The title must be between 5 and 9 characters long.'));
    } elseif (strtolower($title) != $title)
    {
      $form_state->setErrorByName('title', $this->t('The title must be all lowercase characters.'));
    }
  }

  /**
     * @inheritDoc
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $title = $form_state->getValue('title');
        $this->messenger()->addStatus($this->t('You specified a title of %title.', ['%title' => $title]));
    }
}
