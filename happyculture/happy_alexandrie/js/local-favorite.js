(function ($, Drupal) {

  "use strict";

  Drupal.HC = Drupal.HC || {};
  Drupal.HC.Training = Drupal.HC.Training || {};

  Drupal.theme.hcBlockContent = function (localFavsData) {
    var block = document.createElement('div');
    block.setAttribute('class', 'block');
    block.setAttribute('id', 'block-favorite');
    var title = document.createElement('h2');
    title.innerHTML = 'Your favorite';
    block.appendChild(title);
    var content = document.createElement('div');
    content.setAttribute('class', 'content');
    block.appendChild(content);
    var list = document.createElement('ul');
    localFavsData.forEach(function (fav) {
      var item = document.createElement('li');
      item.innerHTML = fav;
      list.appendChild(item);
    });
    content.appendChild(list);
    return block;
  };

  /**
   * Add favorite link before titles.
   */
  Drupal.behaviors.setLocalFavorite = {
    attach: function (context, settings) {
      // Add favorite link to the page (for now based on node title).
      var text = document.createTextNode('favorite');
      var link = document.createElement('a');
      link.setAttribute('href', '#');
      link.setAttribute('class', 'localfav');
      link.appendChild(text);
      $('article .node__title:not(.favorite-processed)').before(link).addClass('favorite-processed');

      // Bind event to store favorite in the localStorage.
      $('.localfav').click(function () {
        var newFav = $(this).next('.node__title').html();
        var localFavsSerial = localStorage.getItem('Drupal.localFavs');
        if (localFavsSerial == null) {
          var localFavsData = new Array();
        }
        else {
          var localFavsData = JSON.parse(localFavsSerial);
        }
        localFavsData.push(newFav);
        localStorage.setItem('Drupal.localFavs', JSON.stringify(localFavsData));
        var block = Drupal.theme('hcBlockContent', localFavsData);
        $('#sidebar-first .region-sidebar-first #block-favorite').remove();
        $('#sidebar-first .region-sidebar-first').append(block);
      });
    }
  };

  /**
   * Create favorite block.
   */
  Drupal.behaviors.createBlockLocalFavorite = {
    attach: function (context, settings) {
      // Get data from the localStorage
      var localFavsSerial = localStorage.getItem('Drupal.localFavs');
      if (localFavsSerial) {
        var localFavsData = JSON.parse(localFavsSerial);
        if (!document.getElementById('block-favorite')) {
          var block = Drupal.theme('hcBlockContent', localFavsData);
          $('#sidebar-first .region-sidebar-first').append(block);
        }
      }
    }
  };

})(jQuery, Drupal);
