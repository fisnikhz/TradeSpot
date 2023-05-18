<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
</head>
<body>

<div class="about-section">
  <h1>About Us Page</h1>
  <p>As a large company, we sell products online.</p>

</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src=".jpg" alt="Endrit" style="width:100%">
      <div class="container">
        <h2>Endrit Gjokaj</h2>
        <p class="title">CEO & Founder</p>
        <p>Endrit Gjokaj is 22 years old. He is from Drenas and has a bachelor's degree in "Hasan Prishtina" University,
             while he continued his master's studies in Vienna, Austria.</p>
        <p>endritgjokaj@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src=".jpg" alt="Verona" style="width:100%">
      <div class="container">
        <h2>Verona Kabashi</h2>
        <p class="title">CEO</p>
        <p>Verona Kabashi is 23 years old. She completed her studies at the bachelor's level at "Hasan Prishtina" University 
            and continued her master's studies in Berlin, Germany. </p>
        <p>veronakabashi@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src=".jpg" alt="Alnita" style="width:100%">
      <div class="container">
        <h2>Alnita Kabashi</h2>
        <p class="title">Art Director</p>
        <p>Alnita Kabashi is 22 years old. She completed her bachelor's studies at "Hasan Prishtina" University, while she continued her master's studies in Switzerland.</p>
        <p>alnitakabashi@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>

<div class="column">
    <div class="card">
      <img src=".../images/psd.jpg" alt="Fisnik" style="width:100%">
      <div class="container">
        <h2>Fisnik Hazrolli</h2>
        <p class="title">Design</p>
        <p>Fisnik Hazrolli is 21 years old. He completed his bachelor's studies at "Hasan Prishtina" University and continued his master's studies in Vienna, Austria together with his colleague Endrit Gjokaj.</p>
        <p>fisnikhazrolli@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>

<div class="column">
    <div class="card">
      <img src=".jpg" alt="Alba" style="width:100%">
      <div class="container">
        <h2>Alba Thaqi</h2>
        <p class="title">Design</p>
        <p>Alba Thaqi is 22 years old. She completed her bachelor's studies at "Hasan Prishtina" University, while she continued her master's studies in America.</p>
        <p>albathaqi@gmail.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>

</body>
</html>
