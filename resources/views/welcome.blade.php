<!DOCTYPE html>
<html lang="es">
<div
  class="export-wrapper"
  style="
    width: auto;
    min-height: auto;
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
  <html>
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Actalia - Registro Digital</title>
      <style id="variables">
        :root {
          --background: #f1f5f9;
          --foreground: #0f172a;
          --primary: #0f2040;
          --primary-foreground: #ffffff;
          --accent-lime: #7ef29d;
          --accent-lime-dark: #4d7c0f;
          --card: #ffffff;
          --border: #cbd5e1;
          --muted: #f8fafc;
          --muted-foreground: #64748b;
          --radius-sm: 4px;
          --radius-md: 8px;
          --radius-lg: 16px;
          --radius-xl: 32px;
        }
      </style>
      <style id="global">
        * {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
        }
        .export-wrapper {
          font-family:
            -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica,
            Arial, sans-serif;
          background-color: var(--background);
          color: var(--foreground);
          -webkit-font-smoothing: antialiased;
          display: flex;
          justify-content: center;
        }
        .screen-container {
          width: 100%;
          max-width: 375px;
          min-height: 812px;
          background-color: #ffffff;
          position: relative;
          display: flex;
          flex-direction: column;
          overflow-y: auto;
          overflow-x: hidden;
        }
      </style>
      <style id="layout">
        /* Fondo Gráfico Moderno Oculto para vista limpia */
        .bg-graphics {
          display: none;
        }

        /* Sección de Logo */
        .logo-section {
          flex: 1;
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          z-index: 2;
          padding: 20px 20px 20px;
          min-height: 300px;
        }
        .logo-box {
          display: flex;
          flex-direction: column;
          align-items: center;
          margin-bottom: 24px;
        }
        .logo-icon {
          width: 72px;
          height: 72px;
          margin-bottom: 12px;
        }
        .logo-text {
          font-size: 46px;
          font-weight: 800;
          color: var(--foreground);
          letter-spacing: -0.04em;
          line-height: 1;
          margin-bottom: 0;
        }
        .logo-subtext {
          font-size: 10px;
          font-weight: 600;
          color: var(--muted-foreground);
          letter-spacing: 0.15em;
          text-transform: uppercase;
          text-align: center;
        }

        /* Tarjeta de Bienvenida plana */
        .onboarding-card {
          background-color: #ffffff;
          padding: 24px 24px 40px;
          z-index: 2;
          position: relative;
        }
      </style>
      <style id="components">
        .card-icon-wrapper {
          width: 56px;
          height: 56px;
          background-color: #f0fdf4;
          border-radius: var(--radius-lg);
          display: flex;
          align-items: center;
          justify-content: center;
          margin-bottom: 24px;
          border: 1px solid #dcfce7;
        }
        .card-title {
          font-size: 32px;
          font-weight: 700;
          color: var(--primary);
          line-height: 1.15;
          letter-spacing: -0.02em;
          margin-bottom: 16px;
        }
        .card-desc {
          font-size: 16px;
          color: var(--muted-foreground);
          line-height: 1.5;
          margin-bottom: 24px;
        }

        /* Contenedor de términos reorganizado para texto largo */
        .terms-container {
          display: flex;
          align-items: flex-start;
          justify-content: flex-start;
          gap: 12px;
          margin-bottom: 24px;
          background-color: var(--muted);
          padding: 16px;
          border-radius: var(--radius-md);
          border: 1px solid var(--border);
        }
        .checkbox {
          width: 20px;
          height: 20px;
          border: 1.5px solid var(--border);
          border-radius: 6px;
          display: flex;
          align-items: center;
          justify-content: center;
          flex-shrink: 0;
          background-color: var(--card);
          margin-top: 2px;
        }
        .terms-text {
          font-size: 13px;
          color: var(--muted-foreground);
          line-height: 1.5;
          text-align: left;
        }
        .terms-link {
          color: var(--primary);
          font-weight: 600;
          display: block;
          margin-top: 6px;
        }

        .actions-container {
          display: flex;
          flex-direction: column;
          gap: 12px;
        }

        /* Botón Principal Destacado */
        .btn-primary {
          background-color: var(--accent-lime);
          color: var(--primary);
          width: 100%;
          height: 60px;
          border-radius: var(--radius-lg);
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 12px;
          font-size: 17px;
          font-weight: 700;
          letter-spacing: 0.01em;
          position: relative;
          overflow: hidden;
          box-shadow: 0 4px 12px rgba(126, 242, 157, 0.3);
        }
        .btn-primary::after {
          content: "";
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          height: 3px;
          background-color: rgba(0, 0, 0, 0.1);
        }

        /* Botón Secundario */
        .btn-secondary {
          background-color: transparent;
          color: var(--primary);
          border: 1.5px solid var(--primary);
          width: 100%;
          height: 60px;
          border-radius: var(--radius-lg);
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 12px;
          font-size: 15px;
          font-weight: 600;
        }
      </style>
    </head>
    <body>
      <div class="screen-container">
        <!-- Logo y Branding -->
        <div class="logo-section">
          <div class="logo-box">
            <div class="logo-icon">
              <!-- Recreación del logo Actalia en SVG -->
              <svg
                viewBox="0 0 100 100"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M 25 80 L 50 20 L 75 80 L 55 80 L 40 45"
                  stroke="var(--accent-lime)"
                  stroke-width="12"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                ></path>
              </svg>
            </div>
            <h1 class="logo-text">actalia</h1>
          </div>
          <h2 class="logo-subtext">Registro Digital de Contratos</h2>
        </div>

        <!-- Tarjeta de Contenido / Bienvenida -->
        <div class="onboarding-card">
          <div class="card-icon-wrapper">
            <div
              style="
                width: 28px;
                height: 28px;
                display: flex;
                align-items: center;
                justify-content: center;
              "
            >
              <iconify-icon
                icon="lucide:file-signature"
                style="font-size: 28px; color: var(--accent-lime-dark)"
              ></iconify-icon>
            </div>
          </div>

          <h3 class="card-title">Registro Digital de contrato de alquiler</h3>
          <p class="card-desc">
            Cargá la información en el momento de la firma para dejar constancia
            digital del acuerdo.
          </p>

          <div class="terms-container" data-media-type="banani-button">
              <label class="terms-label">
                  <input type="checkbox" name="terms" required>
              
                  <span class="terms-text">
                      Acepto los Términos y Condiciones. Entiendo que Actalia no es una
                      escribanía, no certifica firmas ni garantiza la validez legal del
                      contrato, y que el registro es una constancia digital.
                      <span class="terms-link">[Ver términos completos]</span>
                  </span>
              </label>
          </div>

          <div class="actions-container">
            <a href="{{ route('register') }}" id="registerLink">
                <div class="btn-primary" data-media-type="banani-button">
                    <span>Registrar</span>
                
                    <div
                        style="
                            width: 20px;
                            height: 20px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        "
                    >
                        <iconify-icon
                            icon="lucide:arrow-right"
                            style="font-size: 20px; color: var(--primary)"
                        ></iconify-icon>
                    </div>
                </div>
            </a>

           <details style="margin-top: 10px;">
              <summary style="cursor: pointer; font-weight: 600; color: var(--primary);">
                Recuperá tu link de contrato, click aquí
              </summary>
            
              <div style="margin-top: 12px; display: flex; flex-direction: column; gap: 10px;">
              
                <!-- Botón Email -->
                <a
                  href="mailto:admin@actalia.com.ar?subject=Recuperar%20link%20de%20contrato&body=Hola%2C%20quiero%20recuperar%20mi%20link%20de%20contrato.%0A%0AGracias."
                  class="btn-secondary"
                  data-media-type="banani-button"
                  style="display: inline-flex; align-items: center; gap: 10px; text-decoration: none;"
                >
                  <div style="width:20px;height:20px;display:flex;align-items:center;justify-content:center;">
                    <iconify-icon icon="lucide:mail" style="font-size:20px;color:var(--primary)"></iconify-icon>
                  </div>
                  <span>Escribinos por email</span>
                </a>
              
                <!-- Botón WhatsApp -->
                <a
                  href="https://wa.me/11567845821?text=Hola%2C%20quiero%20recuperar%20mi%20link%20de%20contrato."
                  class="btn-secondary"
                  data-media-type="banani-button"
                  style="display: inline-flex; align-items: center; gap: 10px; text-decoration: none;"
                  target="_blank"
                >
                  <div style="width:20px;height:20px;display:flex;align-items:center;justify-content:center;">
                    <iconify-icon icon="lucide:message-circle" style="font-size:20px;color:var(--primary)"></iconify-icon>
                  </div>
                  <span>Escribinos por WhatsApp</span>
                </a>
              
              </div>
            </details>
          </div>
        </div>
      </div>

      <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    </body>
  </html>
  <script src="https://code.iconify.design/iconify-icon/3.0.0/iconify-icon.min.js"></script>
  <style>
    :root {
      --background: #ffffff;
      --foreground: #0b2540;
      --border: #00000014;
      --input: #f6f7f9;
      --primary: #08315a;
      --primary-foreground: #ffffff;
      --secondary: #f4f7fa;
      --secondary-foreground: #0b2540;
      --muted: #e9ebee;
      --muted-foreground: #98a0aa;
      --success: #e6ffea;
      --success-foreground: #1b7a3a;
      --accent: #7ef29d;
      --accent-foreground: #08315a;
      --destructive: #fdecec;
      --destructive-foreground: #9b1c1c;
      --warning: #fff7e6;
      --warning-foreground: #7a5a00;
      --card: #ffffff;
      --card-foreground: #0b2540;
      --sidebar: #f7f9fb;
      --sidebar-foreground: #0b2540;
      --sidebar-primary: #08315a;
      --sidebar-primary-foreground: #ffffff;
      --radius-sm: 4px;
      --radius-md: 6px;
      --radius-lg: 8px;
      --radius-xl: 12px;
      --font-family-body: Inter;
    }
  </style>
</div>

<script>
document.getElementById('registerLink').addEventListener('click', function (e) {
    const checkbox = document.querySelector('input[name="terms"]');

    if (!checkbox.checked) {
        e.preventDefault();

        alert('Debes aceptar los Términos y Condiciones para continuar.');
    }
});
</script>
</html>

