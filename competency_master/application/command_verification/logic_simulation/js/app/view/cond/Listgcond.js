Ext.define('COND.view.cond.Listcond',{
	extend: 'Ext.grid.Panel',
	alias: 'widget.listcond',
	store: 'Sconds',
	title: 'จัดการเงื่อนไข',
	region: 'center',
	defaults: {
        sortable: false
    },
	tbar: [{
		text: 'เพิ่มเงื่อนไข',
		action: 'insert'
	}],

	columns: [
		{ header: 'ID', dataIndex: 'cond_id', flex: 1, hidden: true },
		{ header: 'ชื่อเงื่อนไข', dataIndex: 'cond_name', width: 200},
		{ header: 'คำอธิบาย', dataIndex: 'cond_detail', flex: 1},
		{ header: 'สถานะ', dataIndex: 'cond_status'},
		{ header: '#', dataIndex: 'cond_id', width: 55,sortable: false,
			renderer: function(value, metaData, record, rowIndex,
  colIndex, store, view) {
				var id = Ext.id();
				Ext.Function.defer(function() {
					Ext.create('Ext.button.Button',{
						text: 'แก้ไข',
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
						text: 'สร้างตรรกะ',
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
						text: 'ลบ',
						renderTo: Ext.get('del-'+id),
						scale: 'small',
						handler: function() {

                            Ext.Msg.show({
                                title: 'ลบข้อมูล',
                                msg: 'คุณต้องการลบเงื่อนไขให้กด "Yes" ถ้าไม่ต้องการให้กด "No"',
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
        beforePageText: 'หน้า',
        afterPageText: 'จากทั้งหมด {0} หน้า',
        displayMsg: 'จำนวน {0} - {1} จาก {2}',
		store: 'Sconds',
		dock: 'bottom',
		displayInfo: true
	}],
	sortable: false,
	columnLines: true
});