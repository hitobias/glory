class AddFieldsToUser < ActiveRecord::Migration
  def change
  	add_column :users, :username, :string
  	add_column :users, :name, :string
  	add_column :users, :gender, :integer
  	add_column :users, :birthday, :date
  	add_column :users, :take_office_day, :date
  	add_column :users, :leave_office_day, :date
  	add_column :users, :department, :string
  	add_column :users, :title, :string
  	add_column :users, :image, :string
  	add_column :users, :enable, :boolean, :default => false
  end
end
