Ext.define('COND.view.cond.Listcond',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listcond',
	store: 'Sconds',
	title: '�Ѵ������͹�',
	region: 'center',
	defaults: {
        sortable: false
    },
	tbar: [{
		text: '�������͹�',
		action: 'insert'
	}],

	columns: [
		{ header: 'ID', dataIndex: 'cond_id', flex: 1, hidden: true },
		{ header: '�������͹�', dataIndex: 'cond_name', width: 200},
		{ header: '��͸Ժ��', dataIndex: 'cond_detail', flex: 1},
		{ header: 'ʶҹ�', dataIndex: 'cond_status'},
		{ header: '#', dataIndex: 'cond_id', width: 55,sortable: false,
			renderer: function(value, metaData, record, rowIndex,
  colIndex, store, view) {
				var id = Ext.id();
				Ext.Function.defer(function() {
					Ext.create('Ext.button.Button',{
						text: '���',
						renderTo: Ext.get('ed-'+id),
						handler: function() {
							var editWind = Ext.widget('listcondedit'); // call alias of Listedit.js file
							var editForm = editWind.down('form');  // down form to variable editForm
							editForm.loadRecord(record); // put all data in variable "grid" to this form
							//console.log('Form widget->listcondedit had created'); // show debut of this button
						}
					});
				}, 25);
				return Ext.String.format('<div id="ed-{0}" value="{1}">',id,value);
			}
		},
		{
			header: '#', dataIndex: 'cond_id', width: 75,sortable: false,
			renderer: function(value) {
				var id = Ext.id();
				Ext.Function.defer(function() {

					Ext.create('Ext.button.Button',{
						text: '���ҧ��á�',
						renderTo: Ext.get('lg-'+id),
						handler: function() {
							var dashPanel = Ext.widget('dashlogic');
						}

					});


				}, 25);
				return Ext.String.format('<div id="lg-{0}" value="{1}"></div>',id,value);
			}
		},
		{
			header: '#', dataIndex: 'cond_id', width: 40,sortable: false,
			renderer: function(value, metaData, record, rowIndex,
  colIndex, store, view) {
				var id = Ext.id();
				Ext.Function.defer(function() {

					Ext.create('Ext.button.Button',{
						text: 'ź',
						renderTo: Ext.get('del-'+id),
						scale: 'small',
						handler: function() {

                            Ext.Msg.show({
                                title: 'ź������',
                                msg: '�س��ͧ���ź���͹���顴 "Yes" �������ͧ�����顴 "No"',
                                buttons: Ext.Msg.YESNO,
                                icon: Ext.Msg.QUESTION,
                                fn: function(btn) {
                                    if(btn == 'yes') {
                                        Ext.Ajax.request({
                                            url: 'js/app/data/php/get_condition_list.php',
                                            params: {
                                                id: value,
                                                mod: 'delete'
                                            },
                                            success: function() {
                                                store.load();
                                            }
                                        });
                                    }
                                }

                            });
						}

					});
				}, 25);
				return Ext.String.format('<div id="del-{0}" value="{1}"></div>',id,value);
			}
		}
	],

	dockedItems: [{
		xtype: 'pagingtoolbar',
        beforePageText: '˹��',
        afterPageText: '�ҡ������ {0} ˹��',
        displayMsg: '�ӹǹ {0} - {1} �ҡ {2}',
		store: 'Sconds',
		dock: 'bottom',
		displayInfo: true
	}],
	sortable: false,
	columnLines: true
});