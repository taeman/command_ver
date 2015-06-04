Ext.define('COND.controller.Cond',{
	extend: 'Ext.app.Controller',
	
	stores: [
		'Sconds',
        'Variabletreestore',
		'Propertiestreestore'
	],
	
	models: [
		'Mcond','Mvariable','Mcondgroup'
	],
	
	views: [
		'cond.Listcond',
		'cond.Listedit',
        'logictree.Dashlogic',
        'logictree.Accordionlist',
		'logictree.Droppanel',
		'logictree.Detailpanel',
		'logictree.Variabletreelist',
		'logictree.Propertieslist'
	],
	
	refs: [{
		ref: 'viewListcond',
		selector: 'listcond'
	},{
		ref: 'viewListeditcond',
		selector: 'listcondedit'
	},{
		ref: 'comddVariabletreelist',
		selector: 'variabletreelist'
	},{
        ref: 'comddConditionlist',
        selector: 'propertieslist'
    }],
	
	init: function() {

		this.control({
			'listcond' : {
				//itemdblclick: this.edit
			},
			'listcond button[action=insert]' : {
				click: this.insert
			},
			'listcond button[action=edit]' : {
				
			},
			'listcondedit button[action=save]' : {
				click: this.save
			}	
		}); 
	},
	insert: function() {
		var view = Ext.create('COND.view.cond.Listedit',{
            create: true
        });
	},
	
	edit: function() { //grid, record, item, ind, evt, opt

		var records = this.getViewListcond().getSelectionModel().getSelection();
		
		if(records.length === 1) {
			var editWind = Ext.widget('listcondedit');
			var editForm = editWind.down('form');
			var record = records[0];
			editForm.loadRecord(record);
		}
		
	},
	
	save: function(button) {
        
        var win = button.up('window'),form = win.down('form'), record = form.getRecord(),values = form.getValues();
        var ss = this.getViewListcond().getStore('Sconds');
        
        if(form.getForm().isValid()) {
            Ext.Ajax.request({
                url: 'js/app/data/php/get_condition_list.php',
                params: {
                    cond_id: values['cond_id'],
                    cond_name: values['cond_name'],
                    cond_detail: values['cond_detail'],
                    cond_status: values['cond_status'],
                    gcond_id: values['gcond_id'],
                    mod: 'update'
                },
                success: function() {

                    win.close();
                    ss.load();

                }
            });
        }


	}
});