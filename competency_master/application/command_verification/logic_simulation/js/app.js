Ext.Loader.setConfig({enabled: true});

Ext.application({
	
	name: 'COND',
	appFolder: 'js/app',
	controllers: [
		'Cond'
	],

	launch: function() {
		//console.log('Load dashboard file "app.js".');
		
		Ext.create('Ext.panel.Panel',{
			layout: 'border',
			border: true,
            height: 450,
            bodyPadding: '5 5 5 5',
            defaults: {
                split: true
            },
			items: [{
				xtype: 'listcond',
                region: 'west'
			},{
                layout: 'border',
                region: 'center',
                border: false,
                items: [{
                    region: 'north',
                    xtype: 'cmuidroppanel'
                },{
                    region: 'center',
                    xtype: 'cmuidetailpanel'
                }]

            },{
                layout: 'border',
                region: 'east',
                border: false,
                width: 250,
                items: [{
                    region: 'center',
                    xtype: 'variabletreelist'
                }]
            }],
			renderTo: Ext.get('main_content')
		});
	}
	
});
