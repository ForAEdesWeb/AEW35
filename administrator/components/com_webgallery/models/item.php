<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_webgallery
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */

// no direct access
defined('_JEXEC') or die;

include_once AKPATH_COMPONENT.'/modeladmin.php' ;

/**
 * Webgallery ModelAdmin to edit item.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_webgallery 
 */
class WebgalleryModelItem extends AKModelAdmin
{
    /**
     * The prefix to use with controller messages.
     *
     * @var      string
     * @since    1.6
     */
    protected     $text_prefix = 'COM_WEBGALLERY';
    
    /**
     * The Component name.
     *
     * @var    string 
     */
    protected    $component = 'webgallery' ;
    
    /**
     * The URL view item variable.
     *
     * @var    string 
     */
    protected    $item_name = 'item' ;
    
    /**
     * The URL view list variable.
     *
     * @var    string 
     */
    protected    $list_name = 'items' ;
    
    /**
     * The URL view list to request remote data (only use in API system).
     *
     * @var    string 
     */
    public    $request_item = '';
    
    /**
     * The URL view item to request remote data (only use in API system).
     *
     * @var    string 
     */
    public    $request_list = '';
    
    /**
     * The default method to call. (only use in API system).
     *
     * @var    string 
     */
    public    $default_method = 'getItem';
    
    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @since    1.6
     */
    protected function populateState()
    {
        $this->setState('CCKEngine.enabled', false);
        
        parent::populateState();
    }
    
    /**
     * Prepare and sanitise the table prior to saving.
     *
     * @since    1.6
     */
    protected function prepareTable(&$table)
    {
        parent::prepareTable($table);
    }
    
    /**
     * Function that do something after save.
     *
     * @param   object  $data    The data object.
     *
     * @return  boolean    Save success or not. 
     */
    public function postSaveHook($data = null)
    {
        return true ;
    }
    
    /**
     * Method to get a single record.
     *
     * @param    integer    The id of the primary key.
     *
     * @return    mixed    Object on success, false on failure.
     * @since    1.6
     */
    public function getItem($pk = null)
    {
        if($item = parent::getItem($pk)){
            
            // Get Thumbnails
            $thumbModel = JModelLegacy::getInstance('Thumbnails', 'WebgalleryModel', array('ignore_request' => true));
            
            $thumbModel->setState('filter' , array('item_id' => $item->id) );
            $thumbs = $thumbModel->getItems();
            
            $item->thumbs = new Stdclass;
            
            // Save in Items->thumbs
            foreach( range(1, 5) as $k => $i ):
                $key = 'url' . $i;
                $item->thumbs->$key = $thumbs[$k]->a_url;
            endforeach;
            
            
            return $item ;    
        }

        return false;
    }
    
    /**
     * Method to get the record form.
     *
     * @param    array      $data        An optional array of data for the form to interogate.
     * @param    boolean    $loadData    True if the form is to load its own data (default case), false if not.
     * 
     * @return    JForm    A JForm object on success, false on failure
     * @since    1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = parent::getForm($data, $loadData) ;
        
        return $form ;
    }
    
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return    mixed    The data for the form.
     * @since    1.6
     */
    protected function loadFormData()
    {
        // Set data in session, and parent loadFormData can load it.
        // JFactory::getApplication()->setUserState("com_webgallery.edit.item.data", array());
        
        $data = parent::loadFormData();
        
        return $data ;
    }
    
    /**
     * Method to allow derived classes to preprocess the form.
     *
     * @param   JForm   $form   A JForm object.
     * @param   mixed   $data   The data expected for the form.
     * @param   string  $group  The name of the plugin group to import (defaults to "content").
     *
     * @return  void 
     *
     * @see     JFormField
     * @since   11.1
     * @throws  Exception if there is an error in the form event.
     */
    protected function preprocessForm(JForm $form, $data, $group = 'content')
    {
        return parent::preprocessForm($form, $data, $group);
    }
    
    /**
     * A protected method to get a set of ordering conditions.
     *
     * @param   object    A record object.
     *
     * @return  array  An array of conditions to add to add to ordering queries.
     * @since   1.6
     */
    protected function getReorderConditions($table)
    {
        return parent::getReorderConditions($table) ;
    }
    
    /**
     * Method to set new item ordering as first or last.
     * 
     * @param   JTable  $table      Item table to save.
     * @param   string  $position   "first" to set first or other are set to last.
     *
     * @return  type    
     */
    public function setOrderPosition($table, $position = null)
    {
        // "first" or "last"
        parent::setOrderPosition($table, 'last') ;
    }
    
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param    type       The table type to instantiate
     * @param    string     A prefix for the table class name. Optional.
     * @param    array      Configuration array for model. Optional.
     * 
     * @return    JTable    A database object
     * @since    1.6
     */
    public function getTable($type = null, $prefix = null, $config = array())
    {    
        return parent::getTable( $type , $prefix , $config );
    }
    
    /**
     * Get fields group. This Function is deprecated, use getFieldsGroup instead.
     *
     * @return      array   Fields groups.
     * @deprecated  4.0
     */
    public function getFields()
    {
        // Deprecation warning.
        JLog::add( __CLASS__.'::'.__FUNCTION__.'() is deprecated.', JLog::WARNING, 'deprecated');
        
        $fields = parent::getFields();
        
        return $fields ;
    }
    
    /**
     * Get fields group.
     *
     * @return    array   Fields groups.
     */
    public function getFieldsGroup()
    {
        $fields = parent::getFieldsGroup();
        
        return $fields ;
    }
    
    /**
     * If category need authorize, we can write in this method.
     *
     * @param   int $record category record.
     *
     * @return  boolean Can edit or not.
     */
    public function canCategoryCreate($record)
    {
        $user = JFactory::getUser() ;
        
        return $user->authorise('core.create', $this->option . '.category.' . $record);
    }
}