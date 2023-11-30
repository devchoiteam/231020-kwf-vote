<?php

/**
 * Title: Snake Style
 * Slug: child23/style
 * Categories: query
 * Keywords: style
 * Block Types: core/template-part/style
 */
?>
<style>
    /* 변수 지정 */
    :root {
        --main-bg-color: white;
        --main-point-color: #f25077;
        --title-font-color: dimgray;
        --img-wrap-bg: #eee;
        --submit-btn-color: white;
    }

    .wp-site-blocks {
        background: var(--main-bg-color); 
    }
    .main { 
        background: var(--main-bg-color); 
        max-width: 900px;
        margin: 0 auto;
    }
    .wp-site-blocks {
        padding: 0 !important;
    }
    img {
        width: 100%;
    }

    /* 상단 */
    .main-banner-img {
        width: 100%;
    }
    .main.wp-block-group {
        margin-top: 0 !important;
    }

    /* 서브 타이틀 */
    .sub-title {
        text-align: center;
        font-weight: bold;
        line-height: 2rem;
        color: var(--title-font-color);
    }
    .group-title {
        color: var(--main-point-color);
        text-align: center;
        font-weight: bold;  
        margin-top: 0.7rem;
    }

    /* 투표 이미지 */
    .vote-group {
        display: flex;
    }
    .vote-left, .vote-right {
        flex: 1;
        margin: .3rem;
    }
    .vote-left img, .vote-right img {
        border: 3px solid var(--main-bg-color);
    }
    .vote-left.active img, .vote-right.active img {
        border: 3px solid var(--main-point-color);
    }
    .vote-group .active {
        /* border: .3rem solid #1a65de; */
    }

    /* 투표 체크박스 */
    .vote-checkbox-loc {
        padding: 0.6rem calc(0.6rem - 1px);
    width: 2px;
    margin: 0.2rem auto 0;
        background-size: cover;
        background-image: url("/img/checkboxbtn.png"),
                  url("./img/checkboxbtn.jpg");
    }
    .vote-left.active .vote-checkbox-loc, .vote-right.active .vote-checkbox-loc {
        filter: invert(44%) sepia(82%) saturate(1592%) hue-rotate(315deg) brightness(95%) contrast(99%);
    }

    /* 투표 1/2차 */
    .vote.first .vote-second,
    .vote.second .vote-first {
        display: none;
    }

    /* 투표 버튼 */
    .next-stage-btn, 
    .vote-submit-btn {
        text-align: center;
        font-weight: bold;
        line-height: 3rem;
        background: var(--main-point-color);
        vertical-align: middle;
        margin-top: 1rem;
        color: var(--submit-btn-color);;
    }
    .vote-left:hover, 
    .vote-right:hover,
    .next-stage:hover, 
    .vote-submit:hover {
        cursor: pointer;
    }
    
</style>