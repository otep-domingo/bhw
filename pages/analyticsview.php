<html>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js"></script>
<style>
    .chart-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
        width: 80%;
        margin-right: auto;
        margin-left: auto;
    }

    .chart-card {
        position: relative;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 16px;
        display: flex;
        flex-direction: column;
    }

    .chart-title {
        font-size: 14px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 10px;
    }

    .chart-canvas-wrap {
        position: relative;
    }

    .chart-card canvas {
        width: 100% !important;
        height: auto !important;
    }

    .chart-description {
        font-size: 12px;
        color: #6b7280;
        margin: 10px 0 0;
        line-height: 1.5;
    }

    .btn-enlarge {
        position: absolute;
        top: 0;
        right: 0;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        padding: 4px 8px;
        font-size: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .btn-enlarge:hover {
        background: #f3f4f6;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.open {
        display: flex;
    }

    .modal-box {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        width: min(800px, 90vw);
        max-height: 90vh;
        overflow: auto;
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .modal-title {
        font-size: 16px;
        font-weight: 600;
        color: #111827;
        margin: 0 0 12px;
        padding-right: 36px;
    }

    .modal-box canvas {
        width: 100% !important;
        height: auto !important;
    }

    .modal-description {
        font-size: 13px;
        color: #6b7280;
        margin: 12px 0 0;
        line-height: 1.6;
    }

    .modal-close {
        position: absolute;
        top: 12px;
        right: 12px;
        background: none;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        width: 28px;
        height: 28px;
        font-size: 16px;
        cursor: pointer;
        line-height: 1;
    }

    .modal-close:hover {
        background: #f3f4f6;
    }
</style>

<!-- Wrap each of your existing canvases like this -->
<div class="chart-grid">

    <div class="chart-card">
        <p class="chart-title">Family Planning Users</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartFamilyPlanning')">⛶ Enlarge</button>
            <canvas id="chartFamilyPlanning"></canvas>
        </div>
        <p class="chart-description">Highest: BTL (0) | Lowest: BTL (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Prenatal Services Totals</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartPrenatalServices')">⛶ Enlarge</button>
            <canvas id="chartPrenatalServices"></canvas>
        </div>
        <p class="chart-description">Highest: 1a. ≥4 Prenatal Checkups (0) | Lowest: 1a. ≥4 Prenatal Checkups (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Immunization Summary</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartImmunization')">⛶ Enlarge</button>
            <canvas id="chartImmunization"></canvas>
        </div>
        <p class="chart-description">Highest: Children Protected at Birth (CPAB) (0) | Lowest: Children Protected at Birth (CPAB) (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Nutrition Summary</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartNutrition')">⛶ Enlarge</button>
            <canvas id="chartNutrition"></canvas>
        </div>
        <p class="chart-description">Highest: Early Breastfeeding (<1hr) (0) | Lowest: Early Breastfeeding (<1hr) (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Sick Child Management</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartSickChild')">⛶ Enlarge</button>
            <canvas id="chartSickChild"></canvas>
        </div>
        <p class="chart-description">Highest: Vit A (Sick 6–11m) (0) | Lowest: Vit A (Sick 6–11m) (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Oral Health Services</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartOralHealthServices')">⛶ Enlarge</button>
            <canvas id="chartOralHealthServices"></canvas>
        </div>
        <p class="chart-description">Highest: Orally Fit (12–59m) (0) | Lowest: Orally Fit (12–59m) (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Lifestyle Risk (NCD)</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartNCD')">⛶ Enlarge</button>
            <canvas id="chartNCD"></canvas>
        </div>
        <p class="chart-description">Highest: 1a. Current smoker (0) | Lowest: 1a. Current smoker (0)</p>
    </div>

    <div class="chart-card">
        <p class="chart-title">Vital Statistics Overview</p>
        <div class="chart-canvas-wrap">
            <button class="btn-enlarge" onclick="openModal('chartNatality')">⛶ Enlarge</button>
            <canvas id="chartNatality"></canvas>
        </div>
        <p class="chart-description">Highest: Live births (0) | Lowest: Live births (0)</p>
    </div>

</div>

<!-- Single shared modal -->
<div class="modal-overlay" id="chartModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal()">✕</button>
        <p class="modal-title" id="modalTitle"></p>
        <canvas id="modalCanvas"></canvas>
        <p class="modal-description" id="modalDescription"></p>
    </div>
</div>

<script>
    let modalChartInstance = null;

    function openModal(sourceId) {
        const source = document.getElementById(sourceId);
        const card = source.closest('.chart-card');
        const modal = document.getElementById('chartModal');

        // Pull title and description from the card
        document.getElementById('modalTitle').textContent = card.querySelector('.chart-title').textContent;
        document.getElementById('modalDescription').textContent = card.querySelector('.chart-description').textContent;

        // Get the Chart.js instance from the source canvas
        const sourceChart = Chart.getChart(source);

        // Destroy previous modal chart if any
        if (modalChartInstance) {
            modalChartInstance.destroy();
            modalChartInstance = null;
        }

        // Recreate the same chart on the modal canvas
        const modalCanvas = document.getElementById('modalCanvas');
        modalChartInstance = new Chart(modalCanvas, {
            type: sourceChart.config.type,
            data: sourceChart.config.data,
            options: sourceChart.config.options
        });

        modal.classList.add('open');
    }

    function closeModal() {
        document.getElementById('chartModal').classList.remove('open');
        if (modalChartInstance) {
            modalChartInstance.destroy();
            modalChartInstance = null;
        }
    }

    // Close on backdrop click
    document.getElementById('chartModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Close on Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModal();
    });
</script>

<!-- <canvas id="chartFamilyPlanning"></canvas>
    <canvas id="chartPrenatalServices"></canvas>
    <canvas id="chartImmunization"></canvas>
    <canvas id="chartNutrition"></canvas>
    <canvas id="chartSickChild"></canvas>
    <canvas id="chartOralHealthServices"></canvas>
    <canvas id="chartNCD"></canvas>
    <canvas id="chartNatality"></canvas> -->
<script src="../js/analyticsview.js"></script>
<!-- https://phppot.com/javascript/chartjs-line-chart/ -->
</body>

</html>