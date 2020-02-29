$(function() {
  let i = 0;
  $('.lottery').on('submit', e => {
  i ++;
  e.preventDefault();
  $.ajax({
    url: 'lottery.php',
    type: 'POST',
    dataType: 'json', 
    data: {
      num: $('.sendNum').val(),
    },
    processData: false,
    contentType: false,
  }).done(function(data) {
    if(i < 76) {
      $('.resultTimes').text(i + "回目の抽選です");
    } else {
      $('.resultTimes').text("抽選終了です");
    }
    
    $('.resultNum').text(data);
    
    console.log(data);
  }).fail(function(msg){
    alert(msg);
  });
});
})