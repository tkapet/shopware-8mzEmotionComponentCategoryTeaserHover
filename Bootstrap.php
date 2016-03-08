<?php

use Doctrine\Common\Collections\ArrayCollection;
use Shopware\Models\Emotion\Library\Component;

class Shopware_Plugins_Backend_8mzEmotionComponentCategoryTeaserHover_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    public function getInfo()
    {
        return array(
            'version' => $this->getVersion(),
            'label' => $this->getLabel(),
            'author' => '8mylez',
            'support' => 'http://8mylez.com',
            'link' => 'http://8mylez.com',
            'description' => 'Elegante Mouseover Effekte für das Einkaufswelt Widget: Kategorie-Teaser'
        );
    }

    public function getLabel()
    {
        return '8mylez Einkaufswelt Kategorie Mouseover';
    }

    public function getVersion()
    {
        return "1.0.1";
    }

    public function install()
    {
        $component = $this->createEmotionComponent(
            array(
                'name' => 'Kategorie-Teaser (Mouseover)',
                'template' => 'component_category_teaser_hover_effect',
                'xtype' => 'emotion-components-category-teaser-hover-effect',
                'description' => 'Das Kategorie Teaser Widget in den Einkaufswelten mit zusätzlich coolen Hover Effekten.',
                'convertFunction' => 'getCategoryTeaser'
            )
        );

        $component->createField(array(
            'fieldLabel' => 'Bild Typ',
            'name' => 'image_type',
            'xtype' => 'emotion-components-fields-category-image-type',
            'allowBlank' => true
        ));

        $component->createField(array(
            'fieldLabel' => 'Bild',
            'name' => 'image',
            'xtype' => 'mediaselectionfield',
            'allowBlank' => true
        ));

        $component->createField(array(
            'fieldLabel' => 'Kategorie',
            'name' => 'category_selection',
            'xtype' => 'emotion-components-fields-category-selection'
        ));

        $component->createField(array(
            'fieldLabel' => 'Beschreibung',
            'name' => 'description_text',
            'xtype' => 'textfield'
        ));

        $component->createField(array(
            'fieldLabel' => 'Title Farbe',
            'name' => 'title_color',
            'xtype' => 'textfield',
            'defaultValue' => '#FFFFFF'
        ));

        $component->createField(array(
            'fieldLabel' => 'Beschreibung Farbe',
            'name' => 'description_color',
            'xtype' => 'textfield',
            'defaultValue' => '#FFFFFF'
        ));

        $component->createField(array(
            'fieldLabel' => 'Umrandung Farbe',
            'name' => 'border_color',
            'xtype' => 'textfield',
            'defaultValue' => '#FFFFFF'
        ));

        $component->createHiddenField(array(
            'name' => 'hover_effect_store',
            'allowBlank' => true
        ));

        $this->subscribeEvent(
            'Theme_Compiler_Collect_Plugin_Less',
            'onCollectLessFiles'
        );

        $this->subscribeEvent(
            'Shopware_Controllers_Widgets_Emotion_AddElement',
            'onEmotionAddElement'
        );

        $this->subscribeEvent(
            'Enlight_Controller_Action_PostDispatchSecure_Widgets_Campaign',
            'extendsEmotionTemplates'
        );

        return true;
    }

    public function update($existingVersion)
    {
      return true;
    }

    public function uninstall()
    {
      return true;
    }

    public function getCapabilities()
    {
        return array(
            'install' => true,
            'enable' => true,
            'update' => true,
            'secureUninstall' => true
        );
    }

    public function onCollectLessFiles()
    {
        $lessDir = __DIR__ . '/Views/frontend/_public/src/less/';

        $less = new \Shopware\Components\Theme\LessDefinition(
            array(),
            array(
                $lessDir . 'hovereffect.less'
            )
        );

        return new ArrayCollection(array($less));
    }

    public function onEmotionAddElement(Enlight_Event_EventArgs $arguments)
    {
        $data = $arguments->getReturn();
        $hoverEffect = array();

        if (isset($data['hover_effect_store']) &&
            !empty($data['hover_effect_store'])) {
            $hoverEffect = json_decode($data['hover_effect_store'], true);
        }

        $data['hover_effect'] = $hoverEffect;

        return $data;
    }
}
