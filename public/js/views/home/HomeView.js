define([
  'jquery',
  'underscore',
  'backbone',
  'text!templates/home/homeTemplate.html'
], function($, _, Backbone, homeTemplate){

  var HomeView = Backbone.View.extend({
    el: $("#page"),

    initialize: function () {
        _.bindAll(this, 'render');
    },

    render: function(){
      $('.menu a').removeClass('active');
      $('.menu a[href="#"]').addClass('active');

      this.$el.html(homeTemplate);
    }
  });

  return HomeView;

});
