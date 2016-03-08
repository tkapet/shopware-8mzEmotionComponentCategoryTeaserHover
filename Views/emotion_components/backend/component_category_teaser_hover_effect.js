//{block name="backend/emotion/view/components/category_teaser_hover_effect"}
//{namespace name=backend/emotion/view/components/category_teaser_hover_effect}
Ext.define('Shopware.apps.Emotion.view.components.CategoryTeaserHoverEffect', {
    extend: 'Shopware.apps.Emotion.view.components.Base',
    alias: 'widget.emotion-components-category-teaser-hover-effect',

    snippets: {
        blog_category: {
            fieldLabel: '{s name=blog_category}Blog category{/s}',
            supportText: '{s name=blog_category_support}The selected category is a blog Category{/s}'
        },
        image: '{s name=image}Image{/s}',
        category_selection: '{s name=category_selection}Select category{/s}'
    },

    basePath: '{link file=""}',

    initComponent: function() {
        var me = this;
        me.callParent(arguments);

        me.mediaSelection = me.down('mediaselectionfield');

        me.createHoverEffectField();

        me.createHoverEffectWidgetFieldset();

        me.hoverEffectStoreField = me.getHoverEffectStoreField();

        me.add(me.widgetFieldset);

        var value = '';
        Ext.each(me.getSettings('record').get('data'), function(item) {
            if(item.key == 'image_type') {
                value = item.value;
                return false;
            }
        });

        if(!value || value !== 'selected_image') {
            me.mediaSelection.hide();
        }

        if(me.hoverEffectStoreField && me.hoverEffectStoreField.getValue() !== ""){
            var decodedString = Ext.decode(me.hoverEffectStoreField.getValue());
            me.hoverEffectField.select(decodedString[0].name);
        }
    },

    createHoverEffectField: function() {
        var me = this;

        return me.hoverEffectField = Ext.create('Ext.form.ComboBox', {
            fieldLabel: 'Hover Effekt',
            store: me.createStore(),
            queryMode: 'local',
            displayField: 'name',
            valueField: 'effect',
            listeners:{
                scope: this,
                select: me.onHoverEffectSelection
            }
        });
    },

    createStore: function() {
        var me = this;

        return me.hoverEffectStore = Ext.create('Ext.data.Store', {
            fields: ['effect', 'name'],
            data : [{
                "effect":"oscar", "name":"Oscar"
            },{
                "effect":"sadie", "name":"Sadie"
            },{
                "effect":"marley", "name":"Marley"
            },{
                "effect":"ruby", "name":"Ruby"
            },{
                "effect":"roxy", "name":"Roxy"
            },{
                "effect":"bubba", "name":"Bubba"
            },{
                "effect":"lily", "name":"Lily"
            },{
                "effect":"layla", "name":"Layla"
            },{
                "effect":"romeo", "name":"Romeo"
            },{
                "effect":"dexter", "name":"Dexter"
            },{
                "effect":"sarah", "name":"Sarah"
            }]
        });
    },

    createHoverEffectWidgetFieldset: function() {
        var me = this;

        return me.widgetFieldset = Ext.create('Ext.form.FieldSet', {
            title: 'Hover Effect Settings',
            layout: 'anchor',
            defaults: { anchor: '100%' },
            items: [
                me.hoverEffectField
            ]
        });
    },

    onHoverEffectSelection: function(field, records) {
        var me = this,
            cache = [];

        Ext.each(records, function(record) {
            cache.push(record.data);
        });

        me.hoverEffectStoreField.setValue(Ext.JSON.encode(cache));
    },

    getHoverEffectStoreField: function() {
        var me = this,
            items = me.elementFieldset.items.items,
            storeField;

        Ext.each(items, function(item) {
            if(item.name === 'hover_effect_store') {
                storeField = item;
            }
        });

        return storeField;
    }

});
//{/block}
