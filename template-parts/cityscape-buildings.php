<?php
/**
 * Reusable city architecture. Keep fills tied to the cityscape palette.
 */
?>
<svg class="cityscape-definitions" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="0" height="0">
  <defs>
    <!-- Setback tower: sloping shoulders and a narrow illuminated crown. -->
    <symbol id="city-tower-setback" viewBox="0 0 230 500">
      <path class="cityscape-fill" d="M8 475 35 410 48 185 70 168 78 59 110 8 138 21 151 151 177 175 190 413 222 475 151 494Z"/>
      <path class="cityscape-window" d="m88 65 21-35 6 108-31 12Zm-29 136 57-25 1 21-59 24Zm-2 33 60-23 1 21-62 21Zm-2 34 63-22 1 22-65 21Zm-2 35 66-21 1 23-68 19Zm-2 36 69-20 1 24-71 18Zm-2 37 72-18 1 25-74 16Zm-6 46 80-15 8 24-98 15Zm-16 39 108-15 8 26-128-4Z"/>
      <path class="cityscape-window" d="m137 184 26 18 2 21-27-17Zm2 33 27 18 2 21-28-17Zm2 34 28 18 2 22-29-18Zm2 35 29 19 2 22-30-18Zm2 36 30 19 2 23-31-18Zm2 37 31 19 2 24-32-18Z"/>
      <path class="cityscape-outline" d="M8 475 35 410 48 185 70 168 78 59 110 8 138 21 151 151 177 175 190 413 222 475 151 494ZM110 8 125 161 137 412 151 494M48 185 125 161 177 175M35 410 137 412 190 413M8 475 147 469 222 475"/>
    </symbol>
    <!-- Paired fins echo the original wedge towers and their ribbon windows. -->
    <symbol id="city-tower-fins" viewBox="0 0 250 480">
      <path class="cityscape-fill" d="M8 449 28 402 43 83 91 8 116 317 143 85 180 41 215 407 242 451 154 473Z"/>
      <path class="cityscape-window" d="m50 109 34-49 3 24-38 45Zm-2 37 41-43 2 22-44 41Zm-2 39 47-39 2 23-50 36Zm-2 40 53-35 2 23-56 33Zm-2 41 59-31 2 23-62 29Zm-2 42 65-27 2 23-68 25Zm-2 43 71-23 2 23-74 21Zm-2 44 77-19 2 23-81 17Z"/>
      <path class="cityscape-window" d="m151 115 23-37 2 23-28 36Zm-5 44 33-37 2 23-38 36Zm-5 45 42-37 2 23-47 36Zm-5 45 51-37 2 23-56 36Zm-5 45 60-37 2 23-65 36Zm-5 45 69-37 2 23-74 36Zm-5 45 78-37 2 23-83 36Z"/>
      <path class="cityscape-outline" d="M8 449 28 402 43 83 91 8 116 317 143 85 180 41 215 407 242 451 154 473ZM91 8 126 413 154 473M180 41 194 409 217 456M43 83 60 408 28 402M8 449 154 453 242 451M116 317 111 410 126 413"/>
    </symbol>
    <!-- Terraced mid-rise, with the flared podiums of the existing buildings. -->
    <symbol id="city-midrise-terrace" viewBox="0 0 280 330">
      <path class="cityscape-fill" d="M9 309 32 251 41 142 80 136 84 53 166 13 203 35 211 120 235 138 248 257 272 308 211 324Z"/>
      <path class="cityscape-window" d="m92 66 65-31 1 20-67 30Zm-2 31 69-30 1 20-71 29Zm-42 67 112-27 1 20-114 27Zm-2 32 116-26 1 21-118 26Zm-2 33 120-25 1 22-122 24Zm-7 41 131-24 7 20-147 23Zm-13 31 155-22 8 23-170 6Z"/>
      <path class="cityscape-window" d="m179 45 15 8 2 25-16-8Zm2 39 17 8 2 26-18-9Zm2 65 42 17 2 20-43-17Zm2 32 44 18 2 21-45-18Zm2 33 46 19 2 22-47-19Zm6 39 46 20 9 22-49-21Z"/>
      <path class="cityscape-outline" d="M9 309 32 251 41 142 80 136 84 53 166 13 203 35 211 120 235 138 248 257 272 308 211 324ZM166 13 176 123 185 252 211 324M41 142 176 123 235 138M80 136 176 113 211 120M32 251 185 239 248 257M9 309 206 307 272 308"/>
    </symbol>
    <!-- Low courtyard building for the central district. -->
    <symbol id="city-lowrise-courtyard" viewBox="0 0 300 180">
      <path class="cityscape-fill" d="M8 162 18 81 74 22 202 8 266 61 290 155 220 174Z"/>
      <path class="cityscape-window" d="m38 78 43-44 32-4-36 47Zm52-3 35-46 31-4-27 48Zm52-4 26-47 29-3 22 48Z"/>
      <path class="cityscape-window" d="m26 104 15 1-2 30-16-1Zm24 1 15 1-1 30-16-1Zm25 1 15 1v30l-16-1Zm25 1 15 1 1 30-16-1Zm26 1 15 1 2 30-16-1Zm27 1 15 1 3 30-16-1Zm27 1 15 1 4 30-16-1Zm28 1 15 1 5 30-16-1Zm33-17 15-8 6 29-15 8Zm9 42 15-8 4 17-15 8Z"/>
      <path class="cityscape-outline" d="M8 162 18 81 74 22 202 8 266 61 290 155 220 174ZM18 81 230 84 266 61M202 8 230 84 250 166M8 162 220 158 290 155M18 92 232 95"/>
    </symbol>
  </defs>
</svg>
