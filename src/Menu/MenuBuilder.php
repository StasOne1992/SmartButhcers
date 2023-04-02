<?php
namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use App\Controller\User;

class MenuBuilder
{
    private $factory;

    /**
     * Add any other dependency you need...
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {

        $menu = $this->factory->createItem('root');
       // $menu->addChild('Home', ['route' => 'app_production_index','icon'=>'ss']);
        $menu->addChild('Users',['route'=>'app_user_index','label'=>'Пользователи','icon'=>'users'])
        ;
        $menu->addChild('Classifiers', ['label'=>'Справочники','icon'=>'users']);
        $menu['Classifiers']->setUri('javascript:;.html');
        $menu['Classifiers']->addChild('Справочник ОКЕИ', ['route' => 'app_classifier_o_k_e_i_index']);
        $menu->addChild('Nomenclature',['route'=>'app_nomenclature_index','label'=>'Номенклатура','icon'=>'users'])
        //$menu['Users']->addChild('My comments', ['uri' => '/my_comments']);

     /*   $menu->addChild('Users');
        $menu['Users']->setUri('javascript:;.html');
        $menu['Users']->addChild('My comments', ['uri' => '/my_comments']);
        $menu['Users']->addChild('Edit comments', ['uri' => '/edit_comments']);*/
        ;
        return $menu;
    }

    public function createSidebarMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('sidebar');

        $menu->addChild('Home', ['route' => 'homepage']);
        // ... add more children

        return $menu;
    }

    public function AccountMenu(RequestStack $requestStack)
    {
        $menu = $this->factory->createItem('AccountMenu');
        $menu->addChild('Home', ['route' => 'user/new']);

        return $menu;
    }
}