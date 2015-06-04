Ext.Loader.setConfig({enabled: true});

Ext.application({
	
	name: 'CMUI',
	appFolder: 'app',
	
	launch: function() {
		
		
		
		Ext.create('Ext.panel.Panel', {
			title: 'จัดการตัวแปร',
			layout: 'border',
			width: 1000,
			height: 400,
			defaults: {
				split: true
			},
			items: [{
		        // xtype: 'panel' implied by default
		        title: 'ตัวแปร',
		        region:'west',
		        xtype: 'panel',
		        width: 200,
		        collapsible: true,   // make collapsible
		        id: 'tree-container',
		        layout: 'fit',
		        margins: '5 0 5 5'
		    },{
		        title: 'ข้อมูลตัวแปร',
		        region: 'center',     // center region is required, no width/height specified
		        xtype: 'panel',
		        layout: 'fit',
		        margins: '5 5 5 0',
				html: '<p class="details-info">When you select a layout from the tree, additional details will display here.</p>'
		    }],
			renderTo: Ext.get('ddpanel')
		})
		
	}
	
	
});
