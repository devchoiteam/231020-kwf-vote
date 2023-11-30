<?php

/**
 * Title: Home Script
 * Slug: child23/script
 * Categories: query
 * Keywords: script
 * Block Types: core/template-part/script
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // // Alert 안내문구
    // // 1차 투표 > NEXT 버튼 클릭 > 투표를 덜 한 상태인 경우
    // 'Please check your vote.'
    // // 2차 투표 > 팀선택 > 3팀 이상의 팀을 선택하는 경우
    // 'Sorry, you can select up to 3 teams.'
    // // 2차 투표 > FINISH 버튼 클릭 > 정상 투표 완료 
    // 'Thank you for participating in the voting.'
    // // 2차 투표 > FINISH 버튼 클릭 > 투표를 덜 한 상태인 경우
    // 'Please select 3 teams.'
    // // 2차 투표 > FINISH 버튼 클릭 > 정상적으로 투표가 안된 경우(네트워크/서버문제)
    // 'Sorry, your vote failed.\nIf this problem repeats, please contact us by email\ndevchoiteam@gmail.com'
    // // 2차 투표 > FINISH 버튼 클릭 > 쿠키에 투표 이력이 있는 경우
    // 'You already have a history of participating in voting.'
    // // 2차 투표 > FINISH 버튼 클릭 > 해당기기로 참여 이력이 있는 경우
    // 'Unfortunately, you already have a history of participating in voting.'


    const textFirstVoteFail = 'Please check your vote.';
    const textSecondVoteFail = 'Please select 3 teams.';
    const textSecondVoteFailTooManyCheck = 'Sorry, you can select up to 3 teams.';
    const textSubtmitSuccess = 'Thank you for participating in the voting.';
    const textSubmitError = 'Sorry, your vote failed.\nIf this problem repeats, please contact us by email\ndevchoiteam@gmail.com';
    const textVoteFailHasCookie = 'You already have a history of participating in voting.';
    const textVoteFailHasIpLog = 'Unfortunately, you already have a history of participating in voting.';
    // 쿠키 기록하기
    var setCookie = function(name, value, exp) {
        var date = new Date();
        date.setTime(date.getTime() + exp*24*60*60*1000);
        document.cookie = name + '=' + value + ';expires=' + date.toUTCString() + ';path=/';
    };

    // 쿠키 가져오기
    var getCookie = function(name) {
        var value = document.cookie.match('(^|;) ?' + name + '=([^;]*)(;|$)');
        return value? value[2] : null;
    };
    
    // 쿠키 삭제하기
    var deleteCookie = function(name) {
        document.cookie = name + '=; expires=Thu, 01 Jan 1999 00:00:10 GMT;';
    }

    let fingerPrint = function(fp_text='2023kwf') {
        // create window canvas
        var canvas = document.createElement('canvas');
        canvas.setAttribute("width", 220);
        canvas.setAttribute("height", 30);

        // draw image in window canvas
        var ctx = canvas.getContext('2d');
        ctx.textBaseline = "top";
        ctx.font = "14px 'Arial'";
        ctx.textBaseline = "alphabetic";
        ctx.fillStyle = "#f60";
        ctx.fillRect(125, 1, 62, 20);
        ctx.fillStyle = "#069";
        ctx.fillText(fp_text, 2, 15);
        ctx.fillStyle = "rgba(102, 204, 0, 0.7)";
        ctx.fillText(fp_text, 4, 17);

        // create iframe canvas and ctx
        var iframe_canvas = document.getElementById("fp").contentDocument.createElement('canvas');
        iframe_canvas.setAttribute("width", 220);
        iframe_canvas.setAttribute("height", 30);
        var iframe_ctx = iframe_canvas.getContext('2d');

        // copy image from window canvas to iframe ctx
        iframe_ctx.drawImage(canvas, 0, 0);

        let fpSrc = iframe_canvas.toDataURL();
        let hash = 0;

        for (i = 0; i < fpSrc.length; i++) {
            char = fpSrc.charCodeAt(i);
            hash = (hash * 31)+char;
            hash = hash |= 0; // Convert to 32bit integer;
        }

        return hash;
    }
    var is_voted = getCookie("2023kwf-voted");
    if(is_voted) { // IF 투표가 된 상태, 재접속 제한
        alert(textSubtmitSuccess);
    }

    // 1차 투표
    const firstVoteBtn = document.querySelectorAll('.vote-first .vote-right img, .vote-first .vote-left img');
    firstVoteBtn.forEach((btn) => {
        btn.addEventListener("click", function(img) {
            // try {
                // DO 상대 팀에 active 효과를 삭제
                var item = img.currentTarget;
                var parent = item.parentElement;
                var grand = parent.parentElement;
                grand.children[0].classList.remove('active');
                grand.children[1].classList.remove('active');
                // DO 해당 팀에 active 효과를 적용
                parent.classList.add('active');
            // } catch (e) {}
        });
    });

    // 2차 투표
    const secondVoteBtn = document.querySelectorAll('.vote-second .vote-right, .vote-second .vote-left');
    secondVoteBtn.forEach((btn) => {
        btn.addEventListener("click", function(img) {
            // IF 이미 클릭된 투표를 클릭
            var item = img.currentTarget;
            let bIsActive = item.classList.contains('active');
            if(bIsActive) {
                item.classList.remove('active'); // active 효과를 지움
                return;
            }

            // ELSE IF 투표가 3명이 된 상태
            let nActive = document.querySelectorAll('.vote-second .active').length;
            if(nActive >= 3) {
                alert(textSecondVoteFailTooManyCheck); // 안내 alert을 띄움
                return;
            }

            // ELSE active 효과를 적용
            item.classList.add('active');
        });
    });

    // 1차 투표 완료
    const nextBtn = document.querySelector('.next-stage')
    nextBtn.onclick = function() {
        let nCheckFirstVote = document.querySelectorAll('.vote-first .vote-group .active').length;
        if(nCheckFirstVote < 4) {
            alert(textFirstVoteFail);
            return ;
        }
        document.querySelector('.vote').classList.remove('first');
        document.querySelector('.vote').classList.add('second');
        // 스크롤 상단으로 올리기
        window.scrollTo(0,0);
    };

    
    jQuery(function() {
        // 2차 투표 완료 AJAX
        const submitBtn = document.querySelector('.vote-submit-btn')
        submitBtn.onclick = function() {
            let oParams = {};
            // 1차 투표 정상 체크 확인
            let oFirstVoteGroup = document.querySelectorAll('.vote-first .vote-group');
            for(let i=0; i<oFirstVoteGroup.length; i++) {
                oParams['g'+(i+1)] = (oFirstVoteGroup[i].querySelector('.active').classList.contains('vote-right') ? 'R' : 'L');
            }

            // 2차 투표 정상 체크 확인
            let oSecondVote = document.querySelectorAll('.vote-second .vote-left, .vote-second .vote-right');
            let nSecondVote = 0;
            for(let i=0; i<oSecondVote.length; i++) {
                var bVotedTeam = oSecondVote[i].classList.contains('active');
                oParams['t'+(i+1)] = (bVotedTeam ? 1 : 0);
                if(bVotedTeam) {
                    nSecondVote++;
                }
            }
            if(nSecondVote < 3) {
                alert(textSecondVoteFail);
                return;
            }
            // 쿠키로 1차 제한
            if(getCookie('2023kwf-voted')) {
                alert(textVoteFailHasCookie);
                return;
            }
            // 그래픽 사양을 통해 기기 분류
            oParams['fp'] = fingerPrint();

            setCookie('2023kwf-voted-team', oParams, 60);

            return new Promise(resolve => {
                setTimeout(() => {
                    $.post('/wp-admin/admin-ajax.php', {action: 'save_vote', 'data': oParams,}, function(res) {
                        // 성공 {success: true, data: 1}
                        // 투표 전적 존재 {type: 'voted', time: 'time'}
                        if(res.type == 'voted') {
                            // IP와 기기의 fingerprint 로 2차 제한
                            alert(textVoteFailHasIpLog+'('+res.time+').');
                            setCookie('2023kwf-voted', 'T', 60);
                        } else if(res) {
                            alert(textSubtmitSuccess);
                            setCookie('2023kwf-voted', 'T', 60);
                        } else {
                            alert(textSubmitError);
                        }
                    });
                }, 2000);
                
            });


    };
        
    })
</script>