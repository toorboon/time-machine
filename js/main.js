$(document).ready(function(){
  busy = false; 
  checkDatabase();
  
  
  
  setInterval(function() {
      var date = new Date();
      $('#date-element').html(
          (date.getDate()) + "." + (date.getMonth()+1) + "." + date.getFullYear() + " | " +  date.getHours() + ":" + (( date.getMinutes() < 10 ? "0" : "" ) + date.getMinutes()) + ":" + (( date.getSeconds() < 10 ? "0" : "" ) + date.getSeconds())
          );
    }, 500)
  ;

  $('#stop_button').on('click', function(){
    if (busy) {
      // Write the stop_date to the database and finish that instance
      writeStopDateToDatabase();
    } else {
      swal('Nothing to do!', 'No process is running!','error');
    }
  });

  //This button starts the counter
  $('#start_button').on('click', function(){
    
    if (!(busy)) {
      //Write the start counter to the database
      writeStartDateToDatabase();

    } else {
      swal('Nothing to do!', 'Process is already running!','error');
    }
  });

  
  

  //logs you off the actual session
  $('#logout').on('click', function(){
    $.ajax({
      url:"includes/logout.inc.php",
      method: "post",
      success:function(response)
        {    
          window.location.replace('index.php');
        }
      
      }); 
  });

  function checkDatabase(){
    //check PHP, if a running counter is in there
    // This is necessary due to the reason that the client cannot know for sure, that a session is running, or not. It needs to verify with 
    // For the break feature, you have to add three columns to the database: start_break, end_break, duration_break. 
    // If you click break you set start_break, if you click break again you set end_break and calculate the amount of 
    // minutes and put it to duration and so on
  };

  function writeStopDateToDatabase(){
    //when clicked on stop, write the results into database
      var stopDate = new Date();
      
      // Use this for reformating the date so you can transfer it to mysql
      var SQLDate = stopDate .getFullYear() + "-" + stopDate.getMonth() + "-" + stopDate.getDate() + " " + stopDate.getHours() + ":" + stopDate.getMinutes() + ":" + stopDate.getSeconds(); 
      busy = false;
      clearInterval(x);
      document.getElementById("results").innerHTML = "Stopped";
  }

  function writeStartDateToDatabase(){
    //Set the state for the programme
    busy = true;

    // Set the date we're starting from
    var startDate = new Date(); 

    // Update the counter every 1 second
    x = setInterval(function() {

      // Get date and time for right now
      var now = new Date();
      
      // Find the distance between now and the startDate
      var distance = now-startDate;
      
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="counter"
      document.getElementById("counter").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

    }, 1000);

    // Use this for reformating the date so you can transfer it to mysql
    var SQLDate = startDate .getFullYear() + "-" + startDate.getMonth() + "-" + startDate.getDate() + " " + startDate.getHours() + ":" + startDate.getMinutes() + ":" + startDate.getSeconds(); 
    
    //Write the start counter to the database
    console.log('start_date: ' + SQLDate)
    $.ajax({
      url:"includes/crud.php",
      method:"post",
      data:{action:'insertStartDate', startDate:SQLDate},
      dataType:"text",
      success:function(response)
        {
          if (response){
            // alert(response);
            swal('Well done!', 'The day has started!','success');
          } else {
            // alert(response);
            swal('Oh no!', 'Your day cannot start yet!','error');
          }
        }
    });
  }

}); //end of $(document).ready(function())};