<?php
class ItemId_IndexController extends Omeka_Controller_Action
{
    public function routeAction()
    {
        $db = $this->getDb();
        $sql = "
        SELECT items.id 
        FROM {$db->Item} items 
        JOIN {$db->ElementText} element_texts 
        ON items.id = element_texts.record_id 
        JOIN {$db->Element} elements 
        ON element_texts.element_id = elements.id 
        JOIN {$db->ElementSet} element_sets 
        ON elements.element_set_id = element_sets.id 
        WHERE element_sets.name = 'Dublin Core' 
        AND elements.name = 'Identifier' 
        AND element_texts.text = ?
        LIMIT 1";
        $itemId = $db->fetchOne($sql, $this->_getParam('dc-identifier'));
        if (!$itemId) {
            return $this->_forward('not-found', 'error', 'default');
        }
        return $this->_forward('show', 'items', 'default', array('id' => $itemId));
    }
}