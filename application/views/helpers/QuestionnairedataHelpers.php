<?php
/**
 * This file is part of the CSI QFrame.
 *
 * The CSI QFrame is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The CSI QFrame is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category   QFrame_View
 * @package    QFrame_View_Helper
 * @copyright  Copyright (c) 2007 Collaborative Software Initiative (CSI)
 * @license    http://www.gnu.org/licenses/   GNU General Public License v3
 */


/**
 * @category   QFrame_View
 * @package    QFrame_View_Helper
 * @copyright  Copyright (c) 2007 Collaborative Software Initiative (CSI)
 * @license    http://www.gnu.org/licenses/   GNU General Public License v3
 */
class QFrame_View_Helper_QuestionnairedataHelpers {

  /**
   * Stores the associated view for persistence
   * @var Zend_View_Interface
   */
  private $view = null;

  /**
   * Sets the associated view (should be called automatically by the view)
   *
   * @param Zend_View_Interface
   */
  public function setView($view) {
    $this->view = $view;
  }
  
 /**
  * Generates a drop down box listing all questionnaires
  *
  * @param  integer current questionnaire (or null if no current questionnaire)
  * @param string element name
  * @return string
  */
  public function questionnaireSelect($questionnaireID, $name = 'questionnaire') {
    if($questionnaireID === null) $options[0] = ' ';
    $questionnaires = QuestionnaireModel::getAllQuestionnaires();
    foreach($questionnaires as $questionnaire) {
      $questionnaireName = $this->view->h($questionnaire->questionnaireName);
      $questionnaireVersion = $this->view->h($questionnaire->questionnaireVersion);
      $revision = $this->view->h($questionnaire->revision);
      if(!isset($options[$questionnaire->questionnaireID])) {
        $options[$questionnaire->questionnaireID] = "{$questionnaireName} {$questionnaireVersion}";
        if ($revision != 1) {
          $options[$questionnaire->questionnaireID] .= " r. {$revision}";
        }
      }
    }
    return $this->view->formSelect($name, $questionnaireID, null, $options);
  }
  
 /**
  * Generates a drop down box listing all crypto profiles
  *
  * @param  integer current crypto profile (or null if no current profile)
  * @param string element name
  * @return string
  */
  public function cryptoSelect($cryptoID, $name = 'cryptoID') {
    $options[0] = 'none';
    $cryptos = CryptoModel::getAllProfiles();
    foreach($cryptos as $crypto) {
      $profileName = $this->view->h($crypto->name);
      if(!isset($options[$crypto->cryptoID])) {
        $options[$crypto->cryptoID] = $profileName;
      }
    }
    return $this->view->formSelect($name, $cryptoID, null, $options);
  }

}
