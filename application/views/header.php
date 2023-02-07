<!DOCTYPE html>
<html>
<head>
<base href=<?php echo base_url()?> >
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body{
    margin: 0;
}
.grid-container {
  display: grid;
  grid-template-columns: 25% 25% 25% 25%;
  
}
.home>a,
.logout>a,
.su>a,
.si>a,.kb>a{
        text-decoration: none;
        color: inherit;
}
.grid-container > .item3,.item4 {
    background-color: rgb(238, 233, 233);
    text-align: center;
    align-items: center;
    height: 20px;
    padding: 20px 0;
  }

  .grid-container > .item5,.item6 {
    background-color:white;
    height: 600px;
    padding: 20px 0;

  }
  .item5 > div{
    margin-top: 80px;
    margin-left: 350px;
    height:150px;
    width:450px;
    text-align:left;
  }
  .item5 > div > p{
    font-size: 15px;
  }

.item2,.item4 {
  grid-column-start: 2;
  grid-column-end: 5;
}
.item5{
    grid-column-start: 1;
    grid-column-end: 3;
}
.item6{
    grid-column-start: 3;
    grid-column-end: 5;

}
input[type="email"],input[type="password"]{
    width: 80%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
.primary{
    float: right;
    margin-right: 100px;
    background-color:rgb(43, 42, 42);
    color: white;
    border-radius: 6px;
    font-size: 16px;
    width: 80px;
    height:30px;
    border:none;

}
.alma{
    border: red;
    font-size: 30px;
}


.item6>a:visited {
    color: rgb(243, 104, 40);
    background-color: transparent;
    text-decoration: none;
}


.container1{
    display: flex;
    flex-wrap: nowrap;
    background-color:white;
    margin-top:60px;
}
.container2{
    display: flex;
    flex-wrap: nowrap;
    background-color: white;
}
.container3{
    display: flex;
    flex-wrap: nowrap;
    background-color: white;
}
/*                                                              Navigation Bar CSS START                                                    */
.flex-container{
    display: flex;
    flex-wrap: nowrap;
    color: white;
    background-image:url(<?php echo base_url();?>images/Colored_Shapes.svg);
    background-repeat:no-repeat;
    background-size: cover;
    justify-content: center;
    height:13vh;

}
.flex-logo{

    flex-basis: 40vw; 
    margin-left: 20px;
    align-self:center;

}
.flex-nav{
    flex-basis: 60vw; 
    display: flex;
    flex-wrap: nowrap;
    color: white;
    margin-top: 5vh;
    margin-right: 2vw;
    justify-content: space-between;
    font-size: 18px;
}
div.home>a:link:hover{
    color: rgb(243, 104, 40);
    background-color: transparent;
    text-decoration: none;
}
.on_hover{
    margin-top: 4vh;
    display: none;
    background-color: aqua;
}
.home:hover,.my_area:hover,.kb:hover,.community:hover,.si:hover,.su:hover,.logout:hover{
    color:rgb(225, 123, 7);
}
/*                                                              Navigation Bar CSS START                                                    */

.item4>form{
    margin-left: 500px;
    background-color: white;
    color: #555;
    display: flex;
    padding: 2px;
    width:30vw;
}
.item4>form:focus{
    box-shadow: 0 0 3px 0 black;

}
input[type="search"] {
    border: none;
    background: white;
    margin-bottom: 0;
    width:30vw;
    font-size: 14px;
    color: inherit;
    border: 1px solid transparent;
  }
input[type="search"]::placeholder {
    color: #bbb;
  }
  .item4>form>button[type="submit"] {
    text-indent: -999px;
    overflow: hidden;
    width: 40px;
    padding: 0;
    margin: 0;
    border: 1px solid transparent;
    border-radius: inherit;
    background: transparent url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' class='bi bi-search' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'%3E%3C/path%3E%3C/svg%3E") no-repeat center;
    cursor: pointer;
    opacity: 0.7;
  }
  
  .item4>form>button[type="submit"]:hover {
    opacity: 1;
}
.item4>form>button[type="submit"]:focus,
input[type="search"]:hover {
  box-shadow: 5px 5px;
  border-color:white;
  outline: none;
}
.footer{
    background-color:rgba(182, 180, 180, 0.552);
    height: 200px;
    display: flex;
    justify-content:center;
}
.ticket_button{
    height:7vh;
    width:13vw;
    font-size: larger;
    background-color: gray;
    color: white;
    border-color: transparent;
    border-radius: 50px;
}
.ticket_button:hover{
    cursor: pointer;
    background-color:orange;
}
#myBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    font-size: 18px;
    border: none;
    outline: none;
    background-color: #555;
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 40px;
  }
  #myBtn:hover {
    background-color:orange;
  }
  #sign_up>a:link,#sign_up>a:visited{
    color: rgb(243, 104, 40);
    background-color: transparent;
    text-decoration: none;
  }
  #reset>a:link,#reset>a:visited{
    color: rgb(243, 104, 40);
    background-color: transparent;
    text-decoration: none;
  }
  #agent>a:link, #agent>a:visited{
    color: rgb(243, 104, 40);
    background-color: transparent;
    text-decoration: none;
  }
/*a:link {
    color: inherit;
    background-color: transparent;
    text-decoration: none;
}*/

.ticket_id {
    background-color: lightgray;
}

/* td {
    padding: 0 5vw;
} */
#display_table {
    text-align: center;
    
}
td{
    padding: 0 20px;
    padding-top: 10px;
}

.flex-content {
    margin-top: 15vh;
    display: flex;
    flex-flow: column wrap;
    justify-content: center;
    align-items: center;

}

/* 
.flex-content>div{
    background-color: blue;
    width: 40vw;
    height: 40vh;
    align-self: center;
} */
.submit_ticket {
    margin-top: 5vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-flow: column nowrap;
    gap: 10px;

}

</style>
</head>
<body>
<div class="flex-container">
    <div class="flex-logo" >
        <div class="alma" style="margin-left: 200px;">
            <div style="display: inline;"><img src="<?php echo base_url();?>images/serviceorg-normal.png" style="width:40px ; height:40px; "></div>
            <div style="font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;  display: inline;">AlmaShines</div>
        </div>
            
    </div>
    <div style="flex-grow:4; align-items:center;">
        <div class="flex-nav">
            <div class="home"><a href="http://localhost/practice_ci/service/index">Home</a></div>
            <div class="my_area">My Area</div>
            <div class="kb"><a href="service/admin_login_view">Admin Login</a></div>
            <div class="community">Community</div>
            <div class="si"><a href="index.php">Sign In</a></div>
            <div class="su"><a href="./service/customer_sign_up">Sign Up</a></div>
            <div class="logout"><a href="./service/logout"><i style="font-size:20px" class="fa">&#xf08b;</i></a></div>
        </div>
        <div class="on_hover"><hr></div>
    </div>
</div>
