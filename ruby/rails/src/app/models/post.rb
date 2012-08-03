class Post < ActiveRecord::Base
  attr_accessible :content, :name, :title 
  after_create :after_create
 
  validates :name,  :presence => true
  validates :title, :presence => true,
                    :length => { :minimum => 5 }
                                      
  def after_create()
    Pusher['posts'].trigger('new_post', self.attributes)
  end
  
end