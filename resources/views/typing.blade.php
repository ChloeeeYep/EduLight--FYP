<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">
  <head>
  <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <meta charset="utf-8">  
    <title>Typing Speed Test</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  display: flex;
  padding: 0 10px;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #17A2B8;
}
::selection{
  color: #fff;
  background: #17A2B8;
}
.wrapper{
  width: 770px;
  padding: 35px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 10px 15px rgba(0,0,0,0.05);
}
.wrapper .input-field{
  opacity: 0;
  z-index: -999;
  position: absolute;
}
.wrapper .content-box{
  padding: 13px 20px 0;
  border-radius: 10px;
  border: 1px solid #bfbfbf;
}
.content-box .typing-text{
  overflow: hidden;
  max-height: 256px;
}
.typing-text::-webkit-scrollbar{
  width: 0;
}
.typing-text p{
  font-size: 21px;
  text-align: justify;
  letter-spacing: 1px;
  word-break: break-all;
}
.typing-text p span{
  position: relative;
}
.typing-text p span.correct{
  color: #56964f;
}
.typing-text p span.incorrect{
  color: #cb3439;
  outline: 1px solid #fff;
  background: #ffc0cb;
  border-radius: 4px;
}
.typing-text p span.active{
  color: #17A2B8;
}
.typing-text p span.active::before{
  position: absolute;
  content: "";
  height: 2px;
  width: 100%;
  bottom: 0;
  left: 0;
  opacity: 0;
  border-radius: 5px;
  background: #17A2B8;
  animation: blink 1s ease-in-out infinite;
}
@keyframes blink{
  50%{ 
    opacity: 1; 
  }
}
.content-box .content{
  margin-top: 17px;
  display: flex;
  padding: 12px 0;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  border-top: 1px solid #bfbfbf;
}
.content button{
  outline: none;
  border: none;
  width: 105px;
  color: #fff;
  padding: 8px 0;
  font-size: 16px;
  cursor: pointer;
  border-radius: 5px;
  background: #17A2B8;
  transition: transform 0.3s ease;
}
.content button:active{
  transform: scale(0.97);
}
.content .result-details{
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  width: calc(100% - 140px);
  justify-content: space-between;
}
.result-details li{
  display: flex;
  height: 20px;
  list-style: none;
  position: relative;
  align-items: center;
}
.result-details li:not(:first-child){
  padding-left: 22px;
  border-left: 1px solid #bfbfbf;
}
.result-details li p{
  font-size: 19px;
}
.result-details li span{
  display: block;
  font-size: 20px;
  margin-left: 10px;
}
li span b{
  font-weight: 500;
}
li:not(:first-child) span{
  font-weight: 500;
}
@media (max-width: 745px) {
  .wrapper{
    padding: 20px;
  }
  .content-box .content{
    padding: 20px 0;
  }
  .content-box .typing-text{
    max-height: 100%;
  }
  .typing-text p{
    font-size: 19px;
    text-align: left;
  }
  .content button{
    width: 100%;
    font-size: 15px;
    padding: 10px 0;
    margin-top: 20px;
  }
  .content .result-details{
    width: 100%;
  }
  .result-details li:not(:first-child){
    border-left: 0;
    padding: 0;
  }
  .result-details li p, 
  .result-details li span{
    font-size: 17px;
  }
}
@media (max-width: 518px) {
  .wrapper .content-box{
    padding: 10px 15px 0;
  }
  .typing-text p{
    font-size: 18px;
  }
  .result-details li{
    margin-bottom: 10px;
  }
  .content button{
    margin-top: 10px;
  }
}
</style>
  <body>
    <div class="wrapper">
      <input type="text" class="input-field">
      <div class="content-box">
        <div class="typing-text">
          <p></p>
        </div>
        <div class="content">
          <ul class="result-details">
            <li class="time">
              <p>Time Left:</p>
              <span><b>60</b>s</span>
            </li>
            <li class="mistake">
              <p>Mistakes:</p>
              <span>0</span>
            </li>
            <li class="wpm">
              <p>WPM:</p>
              <span>0</span>
            </li>
            <li class="cpm">
              <p>CPM:</p>
              <span>0</span>
            </li>
          </ul>
          <button>Try Again</button>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('asset/js/paragraphs.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('asset/js/typing.js') }}"></script>
  
  </body>
</html>