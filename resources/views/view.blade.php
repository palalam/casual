@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row row-picture">
        <div class="col-md-4 col-md-offset-4 pictures">
            <div class="slider-box">
                <div class="slider">  
                    @foreach(unserialize($product -> product_photos) as $image)
                        <img style="width: 375px; height: 450px; " src="/storage/images/{{$image}}" alt="image">
                    @endforeach

                 </div>
                <ul class="bullets"></ul>
                <div class="prev"></div>
                <div class="next"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 desc">
            <h2 style="text-align: center">{{$product -> product_title}}</h2>
            <p>{{$product -> product_desc}}</p>
        </div>
    </div>
</div>




@endsection
<style type="text/css">
    div.pictures 
    {
        border: 1px solid red;
        height: 450px;
    }
    div.desc
    {
        height: 200px;
        border: 1px solid blue;
    }

    
</style>
<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



<style type="text/css">
.slider-box{
  position:relative;
  width: 100%;
  height:350px;
  overflow:hidden;
  /*border: 1px solid red;*/
}
.slider{
  position:relative;
  width:10000px;
  height:210px;
}
.slider img{
  float:left;
}
.slider-box .prev, .slider-box .next{
  position:absolute;
  top:100px;
  display:block;
  width:29px;
  height:29px;
  cursor:pointer;
}
.slider-box .prev{
  left:10px;
  /*background:url(../images/slider_controls.png) no-repeat 0 0;*/
  background-color: rgba(0,0,0, 0.7);
  border-radius: 50%;
}
.slider-box .next{
  right:10px;
  background-color: rgba(0,0,0, 0.7);
  border-radius: 50%;
}
.bullets{
  position:absolute;
  bottom:10px;
  left:130px;
  height:11px;
  padding:0;
  margin:0;
  list-style:none;
}
.bullets li{
  width:11px;
  height:11px;
  margin:0 3px 0 0;
  padding:0;
  float:left;
  background-color: rgba(0,0,0, 0.7);
  border-radius: 50%;
}
.bullets li.active{
  background-position:0 -42px;
}
</style>

<script type="text/javascript">
 $(function() {      
  var slider = $('.slider'),
    sliderContent = slider.html(),                      // Содержимое слайдера
    slideWidth = $('.slider-box').outerWidth(),         // Ширина слайдера
    slideCount = $('.slider img').length,               // Количество слайдов
    prev = $('.slider-box .prev'),                      // Кнопка "назад"
    next = $('.slider-box .next'),                      // Кнопка "вперед"
    slideNum = 1,                                       // Номер текущего слайда
  index =0,
  clickBullets=0,
    sliderInterval = 3300,                              // Интервал смены слайдов
    animateTime = 1000,                                 // Время смены слайдов
    course = 1,                                         // Направление движения слайдера (1 или -1)
    margin = - slideWidth;                              // Первоначальное смещение слайдов
 
  for (var i=0; i<slideCount; i++)                      // Цикл добавляет буллеты в блок .bullets
  {
    html=$('.bullets').html() + '<li></li>';          // К текущему содержимому прибавляется один буллет
    $('.bullets').html(html);                         // и добавляется в код
  }
  var  bullets = $('.slider-box .bullets li')          // Переменная хранит набор буллитов
 
 
  $('.slider-box .bullets li:first').addClass('active');  
  $('.slider img:last').clone().prependTo('.slider');   // Копия последнего слайда помещается в начало.
  $('.slider img').eq(1).clone().appendTo('.slider');   // Копия первого слайда помещается в конец.  
  $('.slider').css('margin-left', -slideWidth);         // Контейнер .slider сдвигается влево на ширину одного слайда.
 
  function nextSlide(){                                 // Запускается функция animation(), выполняющая смену слайдов.
    interval = window.setInterval(animate, sliderInterval);
  }
 
  function animate(){
    if (margin==-slideCount*slideWidth-slideWidth  && course==1){     // Если слайдер дошел до конца
      slider.css({'marginLeft':-slideWidth});           // то блок .slider возвращается в начальное положение
      margin=-slideWidth*2;
    }else if(margin==0 && course==-1){                  // Если слайдер находится в начале и нажата кнопка "назад"
      slider.css({'marginLeft':-slideWidth*slideCount});// то блок .slider перемещается в конечное положение
      margin=-slideWidth*slideCount+slideWidth;
    }else{                                              // Если условия выше не сработали,
      margin = margin - slideWidth*(course);            // значение margin устанавливается для показа следующего слайда
    }
    slider.animate({'marginLeft':margin},animateTime);  // Блок .slider смещается влево на 1 слайд.
 
    if (clickBullets==0){                               // Если слайдер сменился не через выбор буллета
    bulletsActive();                                // Вызов функции, изменяющей активный буллет
  }else{                                              // Если слайдер выбран с помощью буллета
    slideNum=index+1;                               // Номер выбранного слайда
  }
  }
 
  function bulletsActive(){
    if (course==1 && slideNum!=slideCount){        // Если слайды скользят влево и текущий слайд не последний
    slideNum++;                                     // Редактирунтся номер текущего слайда
      $('.bullets .active').removeClass('active').next('li').addClass('active'); // Изменить активный буллет
  }else if (course==1 && slideNum==slideCount){       // Если слайды скользят влево и текущий слайд последний
    slideNum=1;                                     // Номер текущего слайда
    $('.bullets li').removeClass('active').eq(0).addClass('active'); // Активным отмечается первый буллет
    return false;
  }else if (course==-1  && slideNum!=1){              // Если слайды скользят вправо и текущий слайд не последни
    slideNum--;                                     // Редактирунтся номер текущего слайда
      $('.bullets .active').removeClass('active').prev('li').addClass('active'); // Изменить активный буллет  
    return false;  
  }else if (course==-1  && slideNum==1){              // Если слайды скользят вправо и текущий слайд последни
    slideNum=slideCount;                            // Номер текущего слайда
    $('.bullets li').removeClass('active').eq(slideCount-1).addClass('active'); // Активным отмечается последний буллет
  }
  }
 
  function sliderStop(){                                // Функция преостанавливающая работу слайдера      
    window.clearInterval(interval);
  }
 
  prev.click(function() {                               // Нажата кнопка "назад"
    if (slider.is(':animated')) { return false; }       // Если не происходит анимация
    var course2 = course;                               // Временная переменная для хранения значения course
    course = -1;                                        // Устанавливается направление слайдера справа налево
    animate();                                          // Вызов функции animate()
    course = course2 ;                                  // Переменная course принимает первоначальное значение
  });
  next.click(function() {                               // Нажата кнопка "назад"
    if (slider.is(':animated')) { return false; }       // Если не происходит анимация
    var course2 = course;                               // Временная переменная для хранения значения course
    course = 1;                                         // Устанавливается направление слайдера справа налево
    animate();                                          // Вызов функции animate()
    course = course2 ;                                  // Переменная course принимает первоначальное значение
  });
  bullets.click(function() {                            // Нажат один из буллетов
    if (slider.is(':animated')) { return false; }       // Если не происходит анимация  
  sliderStop();                                       // Таймер на показ очередного слайда выключается
  index = bullets.index(this);                        // Номер нажатого буллета
  if (course==1){                                     // Если слайды скользят влево
    margin=-slideWidth*index;                       // значение margin устанавливается для показа следующего слайда
  }else if (course==-1){                              // Если слайды скользят вправо
    margin=-slideWidth*index-2*slideWidth;
  }
  $('.bullets li').removeClass('active').eq(index).addClass('active');  // Выбранному буллету добавляется сласс .active
  clickBullets=1;                                     // Флаг информирующий о том, что слайд выбран именно буллетом
  animate();
  clickBullets=0;
  });
 
  slider.add(next).add(prev).hover(function() {         // Если курсор мыши в пределах слайдера
    sliderStop();                                       // Вызывается функция sliderStop() для приостановки работы слайдера
  }, nextSlide);                                        // Когда курсор уходит со слайдера, анимация возобновляется.
 
  nextSlide();                                          // Вызов функции nextSlide()
});
</script>