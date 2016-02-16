class DropPiggybakTables < ActiveRecord::Migration
  def up
  	drop_table :orders
  	drop_table :addresses
  	drop_table :line_items
  	drop_table :shipping_methods
  	drop_table :payment_methods
  	drop_table :payments
  	drop_table :shipments
  	drop_table :shipping_method_values
  	drop_table :payment_method_values
  	drop_table :tax_methods
  	drop_table :countries
  	drop_table :states
  	drop_table :tax_method_values
  	drop_table :order_notes


  end

  def down
  end
end
