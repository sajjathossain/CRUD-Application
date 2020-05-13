
<!------------------------------------------This is the footer code file---------------------------------------------------------->    
    <link rel="stylesheet" href="style.css">
<style>
    
#footer{
    background-color: aquamarine;
    border: 3px solid teal;
    display:grid;
    grid-template-columns: 3fr 1fr;
    color:teal;
    font-weight: bolder;
}

#foot1{
    text-align: center;
}

#foot2{
    text-align: right;
    margin-right:10%;
}
</style>

    <div id="footer">
        <div id="foot1">
            <h3><b>V1.1 Designed & Developed by Sajjad Hosen Provel In May 2020</b></h3>
        </div> 
        <div id="foot2">
            <h3><b>Current-Date:<?php echo date('d/m/y');?></b></h3>
        </div>
    </div>
</body>
</html>