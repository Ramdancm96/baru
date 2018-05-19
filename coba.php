<div id="place"></div>
<script type="text/javascript">
var data = [
       {
          "restaurant": {
             "name": "McDonald's",
             "food": "burger"
          }
       },
       {
          "restaurant": {
             "name": "KFC",
             "food": "chicken"
          }
       },
       {
          "restaurant": {
             "name": "Pizza Hut",
             "food": "pizza"
          }
       }
    ],
    res = JSON.search( data, '//*[food="pizza"]' );

document.getElementById('place').innerHTML = res[0].name;
</script>