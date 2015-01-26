(function ($, Drupal) {

  "use strict";

  /**
   * Add favorite link after titles.
   */
  Drupal.behaviors.setLocalFavorite = {
    attach: function (context, settings) {
      // Function that create the favorite block.
      var createBlockContent = function (localFavsData) {
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

      // Get data from the localStorage
      var localFavsSerial = localStorage.getItem('Drupal.localFavs');
      if (localFavsSerial == null) {
        var localFavsData = new Array();
      }
      else {
        var localFavsData = JSON.parse(localFavsSerial);
        var block = createBlockContent(localFavsData);
        $('#sidebar-first .region-sidebar-first').append(block);
      }

      // Add favorite link to the page (for now based on node title).
      var text = document.createTextNode('favorite');
      var link = document.createElement('a');
      link.setAttribute('href', '#');
      link.setAttribute('class', 'localfav');
      link.appendChild(text);
      $('article .node__title').before(link);

      // Bind event to store favorite in the localStorage.
      $('.localfav').click(function () {
        var newFav = $(this).next('.node__title').html();
        localFavsData.push(newFav);
        localStorage.setItem('Drupal.localFavs', JSON.stringify(localFavsData));
        var block = createBlockContent(localFavsData);
        $('#sidebar-first .region-sidebar-first #block-favorite').remove();
        $('#sidebar-first .region-sidebar-first').append(block);
      });
    }
  };

})(jQuery, Drupal);
