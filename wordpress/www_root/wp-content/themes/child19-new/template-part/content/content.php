<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2023KWF</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./js/main.js"></script>
  <!-- wp:pattern {"slug":"child23/style"} /-->

<main class="main wp-block-group">

	<!-- 행사 이미지 -->
  <div class="main-banner-wrap">
    <img class="main-banner-img" src='/img/main-banner.png' onerror="this.onerror=null; this.src= '/img/main-banner.jpg'">
  </div>

  <!-- 투표 -->
  <div class="vote vote-wrap first">

    <!-- 1차 투표: 그룹 투표 -->
		<div class="vote-first">

      <!-- 1차 투표완료 버튼 -->
      <div class="sub-title">
        <div>PLEASE SELECT ONE TEAM FROM EACH GROUP</div>
      </div>
      <div class="group-title">BEYOND FANDOM</div>
      <div class="vote-group">
        <div class="vote-left">
          <img class="vote-team-img" src="/img/vote1-team1.png" onerror="this.onerror=null; this.src= '/img/vote1-team1.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
        <div class="vote-right">
          <img src="/img/vote1-team2.png" onerror="this.onerror=null; this.src= '/img/vote1-team2.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
      </div>
      
      <div class="group-title">BEYOND FORM</div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote1-team3.png" onerror="this.onerror=null; this.src= '/img/vote1-team3.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
        <div class="vote-right">
          <img src="/img/vote1-team4.png" onerror="this.onerror=null; this.src= '/img/vote1-team4.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
      </div>
      
      <div class="group-title">BEYOND STAR</div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote1-team5.png" onerror="this.onerror=null; this.src= '/img/vote1-team5.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
        <div class="vote-right">
          <img src="/img/vote1-team6.png" onerror="this.onerror=null; this.src= '/img/vote1-team6.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
      </div>
      
      <div class="group-title">BEYOND TIME</div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote1-team7.png" onerror="this.onerror=null; this.src= '/img/vote1-team7.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
        <div class="vote-right">
          <img src="/img/vote1-team8.png" onerror="this.onerror=null; this.src= '/img/vote1-team8.jpg'">
          <div class="vote-checkbox-loc" onclick="this.previousElementSibling.click()"></div>
        </div>
      </div>

      <!-- 1차 투표완료 버튼 -->
      <div class="next-stage">
        <div class="next-stage-btn">NEXT</div>
      </div>

		</div>

    <!-- 2차 투표: 개별 투표 -->
    <div class="vote-second">
      <div class="sub-title">
        <div>PLEASE SELECT THREE TEAMS</div>
      </div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote2-team1.png" onerror="this.onerror=null; this.src= '/img/vote2-team1.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
        <div class="vote-right">
          <img src="/img/vote2-team2.png" onerror="this.onerror=null; this.src= '/img/vote2-team2.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
      </div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote2-team3.png" onerror="this.onerror=null; this.src= '/img/vote2-team3.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
        <div class="vote-right">
          <img src="/img/vote2-team4.png" onerror="this.onerror=null; this.src= '/img/vote2-team4.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
      </div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote2-team5.png" onerror="this.onerror=null; this.src= '/img/vote2-team5.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
        <div class="vote-right">
          <img src="/img/vote2-team6.png" onerror="this.onerror=null; this.src= '/img/vote2-team6.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
      </div>
      <div class="vote-group">
        <div class="vote-left">
          <img src="/img/vote2-team7.png" onerror="this.onerror=null; this.src= '/img/vote2-team7.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
        <div class="vote-right">
          <img src="/img/vote2-team8.png" onerror="this.onerror=null; this.src= '/img/vote2-team8.jpg'"/>
          <div class="vote-checkbox-loc" onclick="this.perentElement.click()"></div>
          </div>
      </div>
      
      <!-- 2차 투표완료 버튼 -->
      <div class="vote-submit">
        <div class="vote-submit-btn">FINISH</div>
      </div>

		</div>

	</div>

</main>
<iframe id="fp" style="display: none;"></iframe>
<!-- wp:pattern {"slug":"child23/script"} /-->
</body>
</html>