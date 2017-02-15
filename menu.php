<?php
// create menu and item objects
$menu = new template('menu.menu');
$menu->set('items', false);
$item = new template('menu.item');
// main menu content query
$sql = 'SELECT content_id, title FROM content WHERE '.
    'parent_id="0" AND show_in_menu="1"';
if(ROLE_ID != ROLE_ADMIN)
{
    $sql .= ' AND is_hidden = 0';
}
$sql = $sql.' ORDER BY sort ASC';
// get menu data from database
$res = $db->getArray($sql);
// create menu items from query result
if($res != false){
    foreach ($res as $page){
        // add content to menu item
        $item->set('name', tr($page['title']));
        $link = $http->getLink(array('page_id'=>$page['content_id']));
        $item->set('link',$link);
        $menu->add('items', $item->parse());
    }
}
if(USER_ID != ROLE_NONE)
{
    $link = $http->getLink(array('act' => 'logout'));
    $item->set('link', $link);
    $item->set('name', 'tr(Logi valja)');
    $menu->add('items', $item->parse());
}
$tmpl->set('menu', $menu->parse());