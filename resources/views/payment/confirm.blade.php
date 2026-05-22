<x-guest-layout>
<!DOCTYPE html>
<body>

<div
  class="export-wrapper"
  style="
    width: auto;
    min-height: 812px;
    position: relative;
    font-family: var(--font-family-body);
    background-color: var(--background);
  "
>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@100;200;300;400;500;600;700;800;900&family=Geist:wght@100;200;300;400;500;600;700;800;900&family=IBM+Plex+Mono:wght@100;200;300;400;500;600;700&family=IBM+Plex+Sans:wght@100;200;300;400;500;600;700&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:wght@200;300;400;500;600;700;800;900&family=PT+Serif:wght@400;700&family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&family=Shantell+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
  />
  <html lang="es">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Registro Digital - Validación y Confirmación</title>
      <style id="reset-styles">
        * {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
        }
        .export-wrapper {
          background-color: #f3f4f6;
          color: var(--foreground);
          -webkit-font-smoothing: antialiased;
          display: flex;
          flex-direction: column;
          align-items: center;
          padding: 32px 16px;
          gap: 40px;
          min-height: 100vh;
        }
      </style>
      <style id="layout-styles">
        .app-wrapper {
          width: 100%;
          max-width: 375px;
          min-height: 812px;
          display: flex;
          flex-direction: column;
          background-color: var(--background);
          border-radius: 24px;
          box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
          overflow: hidden;
          flex-shrink: 0;
        }
        .main-content {
          flex: 1;
          padding: 24px 20px 32px;
          display: flex;
          flex-direction: column;
          gap: 24px;
        }
        .bottom-bar {
          border-top: 1px solid var(--border);
          background-color: var(--card);
          padding: 16px 20px 28px;
          display: flex;
          flex-direction: column;
          gap: 12px;
        }
        .btn-primary {
          width: 100%;
          border-radius: var(--radius-lg);
          background-color: var(--primary);
          color: var(--primary-foreground);
          padding: 14px 16px;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          font-size: 15px;
          font-weight: 500;
        }
        .btn-secondary {
          width: 100%;
          border-radius: var(--radius-lg);
          background-color: transparent;
          color: var(--primary);
          border: 1px solid var(--primary);
          padding: 14px 16px;
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 8px;
          font-size: 15px;
          font-weight: 600;
        }
        .btn-icon-wrapper {
          width: 20px;
          height: 20px;
          display: flex;
          align-items: center;
          justify-content: center;
        }
      </style>
      <style id="success-styles">
        .success-header {
          display: flex;
          flex-direction: column;
          align-items: center;
          text-align: center;
          gap: 20px;
          padding: 32px 0 16px;
        }
        .seal-badge {
          display: inline-flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          gap: 8px;
          width: 160px;
          height: 160px;
          border-radius: 50%;
          background-color: var(--primary);
          box-shadow: 0 0 0 8px rgba(0, 0, 0, 0.03);
          margin-bottom: 8px;
        }
        .seal-text {
          font-size: 13px;
          font-weight: 700;
          text-transform: uppercase;
          letter-spacing: 0.05em;
          text-align: center;
          line-height: 1.3;
          color: var(--primary-foreground);
        }
        .success-title {
          font-size: 24px;
          font-weight: 700;
          color: var(--primary);
          line-height: 1.2;
        }
        .success-card {
          background-color: var(--card);
          border-radius: var(--radius-lg);
          border: 1px solid var(--border);
          padding: 24px 20px;
          display: flex;
          flex-direction: column;
          gap: 16px;
          margin-top: 16px;
        }
        .success-card-item {
          display: flex;
          flex-direction: column;
          gap: 6px;
        }
        .success-card-label {
          font-size: 12px;
          font-weight: 600;
          color: var(--muted-foreground);
          text-transform: uppercase;
          letter-spacing: 0.05em;
        }
        .success-card-value {
          font-size: 14px;
          color: var(--foreground);
          line-height: 1.5;
          font-weight: 500;
        }
        .success-text {
          color: var(--primary);
          font-weight: 600;
          display: flex;
          align-items: center;
          gap: 8px;
          font-size: 15px;
        }
        .success-divider {
          height: 1px;
          background-color: var(--border);
          margin: 4px 0;
        }
      </style>
    </head>
    <body>
      <div class="app-wrapper">
        <main
          class="main-content"
          style="
            justify-content: center;
            padding-top: 48px;
            padding-bottom: 48px;
          "
        >
          <div class="success-header">
            <div class="seal-badge">
              <div
                style="
                  width: 56px;
                  height: 56px;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                "
              >
                <iconify-icon
                  icon="lucide:clock"
                  style="font-size: 48px; color: #a3e635"
                ></iconify-icon>
              </div>
              <span class="seal-text">Contrato<br />enviado</span>
            </div>
            <div
              style="
                display: flex;
                flex-direction: column;
                gap: 8px;
                align-items: center;
                text-align: center;
              "
            >
              <h1 class="success-title" style="font-size: 22px">
                Registro digital en proceso
              </h1>
              <span style="font-size: 15px; font-weight: 500; color: #6b7280"
                >Gracias por usar Actalia. En 48hs. hábiles recibirás la
                confirmación.</span
              >
            </div>
          </div>

          <div class="success-card">
            <div class="success-card-item">
              <div class="success-card-label">Estado del documento</div>
              <div class="success-card-value success-text">
                <div
                  style="
                    width: 18px;
                    height: 18px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  "
                >
                  <iconify-icon
                    icon="lucide:clock"
                    style="font-size: 18px"
                  ></iconify-icon>
                </div>
                Aprobación pendiente
              </div>
            </div>

            <div class="success-divider"></div>

            <div class="success-card-item">
              <div class="success-card-label">Trazabilidad</div>
              <div class="success-card-value">
                La información de las identidades firmantes ya están asociadas
                al registro del contrato.
              </div>
            </div>

            <div class="success-divider"></div>

            <div class="success-card-item">
              <div class="success-card-label">Fecha y hora del registro</div>
              <div class="success-card-value">
                  {{ $contract->created_at->format('d/m/Y - H:i') }} hs
              </div>
            </div>
          </div>

        </main>

        <footer class="bottom-bar">
          <a href="{{ route('payment.ticket', $contract->unique_token) }}" 
             class="btn-primary" 
             data-media-type="banani-button"
             style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">

              <div class="btn-icon-wrapper" style="color: currentColor">
                  <iconify-icon icon="lucide:download" style="font-size: 18px"></iconify-icon>
              </div>
            
              <span>Descargar constancia de registro</span>
          </a>

          <a href="{{ route('register') }}" 
             class="btn-secondary" 
             data-media-type="banani-button"
             style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px;">
                  
              <div class="btn-icon-wrapper" style="color: currentColor">
                  <iconify-icon icon="lucide:file-plus" style="font-size: 18px"></iconify-icon>
              </div>
            
              <span>Registrar otro contrato</span>
          </a>
        </footer>
      </div>
    </body>
  </html>
  <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
  <style>
    :root {
      --background: #ffffff;
      --foreground: #072241;
      --border: #00000014;
      --input: #f6f9fb;
      --primary: #0a5faa;
      --primary-foreground: #ffffff;
      --secondary: #eaf4ff;
      --secondary-foreground: #0a5faa;
      --muted: #f3f4f6;
      --muted-foreground: #98a0a8;
      --success: #cff6a8;
      --success-foreground: #274e00;
      --accent: #c7f02a;
      --accent-foreground: #072400;
      --destructive: #ffe7e7;
      --destructive-foreground: #8b1e1e;
      --warning: #fff3d6;
      --warning-foreground: #6a4b00;
      --card: #ffffff;
      --card-foreground: #072241;
      --sidebar: #f8fbfd;
      --sidebar-foreground: #072241;
      --sidebar-primary: #eaf4ff;
      --sidebar-primary-foreground: #0a5faa;
      --radius-sm: 4px;
      --radius-md: 6px;
      --radius-lg: 8px;
      --radius-xl: 12px;
      --font-family-body: Inter;
    }
  </style>
</div>


</body>
</html>
</x-guest-layout>