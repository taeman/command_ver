Ext.define('COND.controller.Comdd',{
	extend: 'Ext.app.Controller',
	
	stores: [
		'Variabletreestore',
		'Propertiestreestore'
	],
	
	views: [
		'logictree.Accordionlist',
		'logictree.Droppanel',
		'logictree.Detailpanel',
		'logictree.Variabletreelist',
		'logictree.Propertieslist'
	],
	refs: [{
		ref: 'comddMenutreelist',
		selector: 'variabletreelist'
	}],
	
	init: function() {
		console.log('--Load Controller Comdd.js already...');
		
		this.control({
			'variabletreelist' : {
				itemclick: {
					fn : function(view,record,item,index,event) {
						console.log('---Node id ['+ record.data.text +'] have to click');
						//console.info(view);
					}
				}
			}
		});
		
	}
});
