<?php

 function presentPrice($price)
 {
     return ('$' . number_format($price / 100, 2, ".", ","));
 }

 function setActiveCategory($slug)
 {
     return request()->category == $slug ? 'active' : '';
 }
