Ext.define('COND.view.cond.Listedit',{
	extend: 'Ext.window.Window',
	alias: 'widget.listcondedit',
	title: '������͹�',
	layout: 'fit',
	autoShow: true,
    constrain: true,
	modal: true,
	y: 150,


	initComponent: function() {
		this.items = [{
			xtype: 'form',
            bodyPadding: 10,
            padding: '10 10 10 10',
            defaults: {
                width: 500
            },
			items: [{
                xtype: 'hiddenfield',
                name: 'cond_id',
                ref: 'cid'
            },{
				xtype: 'textfield',
				name: 'cond_name',
				ref: 'cname',
				fieldLabel: '�������͹�',
				allowBlank: false
			},{
				xtype: 'combobox',
                id: 'gcondIdbox',
				name: 'gcond_id',
                store: new Ext.data.Store({
                    autoLoad: true,
                    model: 'COND.model.Mcondgroup',
                    fields: ['gcond_id','gcond_name'],
                    proxy: {
                        type: 'ajax',

                        url: 'js/app/data/php/get_gcondition_list.php',
                        actionMethods: {
                            read: 'POST'
                        },
                        reader: {
                            type: 'json',
                            root: 'data'
                        }
                    },
                    listeners: {
                        load: function(store, option) {
                            var combo = Ext.getCmp('gcondIdbox');
                            combo.setValue(combo.getValue());
                        }
                    }
                }),
				fieldLabel: '��Ǵ������ʹѺʹع����ʴ���',
                displayField: 'gcond_name',
                valueField: 'gcond_id',
                queryMode: 'local',
                editable: false
			},{
				xtype: 'textarea',
				name: 'cond_detail',
				ref: 'cdetail',
				fieldLabel: '��͸Ժ��',
				allowBlank: false
			},{
                xtype: 'checkbox',
                name: 'cond_status',
                ref: 'cstatus',
                fieldLabel: 'ʶҹС����ҹ',
                inputValue: 1,
                allowBlank: true

            }]
		}];

        

		this.buttons = [{
			text: '�ѹ�֡',
            action: 'save'
		},{
			text: '¡��ԡ',
			scope: this,
			handler: this.close
		}];
		
		this.callParent(arguments);
	}
	
});