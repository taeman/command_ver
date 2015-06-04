Ext.Loader.setConfig({enabled: true});

Ext.application({
	
	name: 'CMUI',
	appFolder: 'app',
	
	
	launch: function() {
		
		
		
		Ext.create('Ext.panel.Panel', {
			title: 'manage variable',
			layout: 'border',
			width: '100%',
			height: 450,
			defaults: {
				split: true
			},
			items: [{
		        // xtype: 'panel' implied by default
		        title: 'variable and variable group',
		        region:'west',
		        xtype: 'panel',
		        width: 350,
				layout:'accordion',
				//autoScroll: true,
		        //collapsible: true,   // make collapsible
		        id: 'tree-container',
		        //layout: 'fit',
		        margins: '5 0 5 5',
				//activeItem:1,
				items: [{
						title: 'variable group', 
						html: '<DIV id="tree-detail-container-group"></DIV>',
						autoScroll: true,
						iconCls: 'folder'
						},{
						title: 'variable',
						//activeOnTop: true,
						autoScroll: true,
						activeItem: 0,
						html: '<DIV id="tree-detail-container"></DIV>',
						iconCls: 'folder'
						}]
		    },{
		        title: '',
		        region: 'center',     // center region is required, no width/height specified
		        xtype: 'panel',
				id: 'detail-container',
		        layout: 'fit',
				autoScroll: true,
		        margins: '5 5 5 0',
				html: '<DIV id="body-detail-container"></DIV>'
		    }],
			renderTo: Ext.get('manage_variable_panel')
		})
		
	}
	

});
