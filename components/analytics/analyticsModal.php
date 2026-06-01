<style>
    .analytics-modal{
        display:none;
        position:fixed;
        z-index:9999;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.6);
        justify-content:center;
        align-items:center;
    }

    .analytics-content{
        background:#fff;
        width:90%;
        max-width:1000px;
        border-radius:12px;
        padding:20px;
        animation:fadeIn .3s ease;
    }

    .analytics-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    }

    .analytics-header h2{
        margin:0;
        font-size:22px;
    }

    .close-modal{
        font-size:28px;
        cursor:pointer;
        font-weight:bold;
    }

    .analytics-body{
        width:100%;
        height:500px;
    }
    .section-a {
        width:100%;
        height:100%;
    }

    @keyframes fadeIn{
        from{
            transform:translateY(-10px);
            opacity:0;
        }
        to{
            transform:translateY(0);
            opacity:1;
        }
    }

</style>

<div id="analyticsModal" class="analytics-modal">
    <div class="analytics-content">
        <div class="analytics-header">
            <h2>
                Analytics Dashboard
            </h2>
            <span class="close-modal" onclick="closeAnalytics()">
                &times;
            </span>
        </div>
        <div class="analytics-body">
            <div class="section-a">
                <h4>Section A: Family Planning Analytics</h4>
                <canvas id="analyticsChart"></canvas>
            </div>
        </div>
    </div>
</div>