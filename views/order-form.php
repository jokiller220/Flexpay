<section id="view-order-form" class="view">
            <div class="order-form-sticky-header">
                <div class="order-form-header">
                    <button class="back-btn" id="order-form-back-btn" onclick="app.orderFormBack()"><i class="fa-solid fa-chevron-left"></i></button>
                    <div class="order-form-header-content">
                        <div id="order-form-service-icon-small" class="order-form-svc-icon"></div>
                        <h2 id="order-form-title">Commander</h2>
                    </div>
                </div>

                <!-- Step indicator -->
                <div class="order-form-stepper" id="order-form-stepper">
                    <!-- Rendered dynamically -->
                </div>
            </div>

            <!-- Dynamic content area -->
            <div class="order-form-body" id="order-form-body">
                <!-- Rendered dynamically -->
            </div>

            <!-- Navigation buttons -->
            <div class="order-form-footer" id="order-form-footer">
                <button class="btn btn-primary btn-block" id="order-form-next-btn" onclick="app.orderFormNext()">Continuer</button>
            </div>
        </section>