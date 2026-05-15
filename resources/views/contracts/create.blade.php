<x-guest-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registro de Contrato - Registrado</title>
    
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 25px;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .section-title {
            color: #667eea;
            font-weight: 700;
            margin-top: 30px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #667eea;
        }
        .required {
            color: #dc3545;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
                
                <div class="card">
                    <!-- Header -->
                    <div class="card-header text-center">
                        <h1 class="h3 mb-0">📋 Registro de Contrato</h1>
                        <p class="mb-0 mt-2">Complete todos los datos del contrato</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <form method="POST" action="{{ route('contracts.store') }}" id="contractForm">
                            @csrf
                            
                            <!-- SECCIÓN 1: DATOS DE LA PROPIEDAD -->
                            <h4 class="section-title">🏠 Datos de la Propiedad</h4>
                            
                            <div class="row">
                                <!-- Tipo de Contrato -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="contract_type" class="form-label">
                                            Tipo de Alquiler <span class="required">*</span>
                                        </label>
                                        <select class="form-select @error('contract_type') is-invalid @enderror" 
                                                id="contract_type" 
                                                name="contract_type" 
                                                required>
                                            <option value="" selected disabled>Seleccione tipo</option>
                                            <option value="vivienda" {{ old('contract_type') == 'vivienda' ? 'selected' : '' }}>
                                                Vivienda
                                            </option>
                                            <option value="comercial" {{ old('contract_type') == 'comercial' ? 'selected' : '' }}>
                                                Comercial
                                            </option>
                                        </select>
                                        @error('contract_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Nombre de la Propiedad -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="property_name" class="form-label">
                                            Nombre de la Propiedad
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('property_name') is-invalid @enderror" 
                                               id="property_name" 
                                               name="property_name"
                                               value="{{ old('property_name') }}"
                                               placeholder="Ej: Depto 2 ambientes">
                                        @error('property_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Dirección -->
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="address" class="form-label">
                                            Dirección <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('address') is-invalid @enderror" 
                                               id="address" 
                                               name="address"
                                               value="{{ old('address') }}"
                                               placeholder="Calle y número"
                                               required>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Unidad -->
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="unit" class="form-label">
                                            Unidad
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('unit') is-invalid @enderror" 
                                               id="unit" 
                                               name="unit"
                                               value="{{ old('unit') }}"
                                               placeholder="pb, 3ro D, etc">
                                        @error('unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Ciudad -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="city" class="form-label">
                                            Ciudad <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('city') is-invalid @enderror" 
                                               id="city" 
                                               name="city"
                                               value="{{ old('city', 'Córdoba') }}"
                                               required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Provincia -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="province" class="form-label">
                                            Provincia <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('province') is-invalid @enderror" 
                                               id="province" 
                                               name="province"
                                               value="{{ old('province', 'Córdoba') }}"
                                               required>
                                        @error('province')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- Fecha Inicio -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="start_date" class="form-label">
                                            Inicio del Contrato <span class="required">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control @error('start_date') is-invalid @enderror" 
                                               id="start_date" 
                                               name="start_date"
                                               value="{{ old('start_date') }}"
                                               required>
                                        @error('start_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Fecha Fin -->
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-label">
                                            Fin del Contrato <span class="required">*</span>
                                        </label>
                                        <input type="date" 
                                               class="form-control @error('end_date') is-invalid @enderror" 
                                               id="end_date" 
                                               name="end_date"
                                               value="{{ old('end_date') }}"
                                               required>
                                        @error('end_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Alquiler Mensual -->
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="monthly_rent" class="form-label">
                                            Alquiler Mensual (opcional)
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" 
                                                   class="form-control @error('monthly_rent') is-invalid @enderror" 
                                                   id="monthly_rent" 
                                                   name="monthly_rent"
                                                   value="{{ old('monthly_rent') }}"
                                                   placeholder="150000"
                                                   step="0.01">
                                        </div>
                                        @error('monthly_rent')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- SECCIÓN 2: INQUILINO -->
                            <h4 class="section-title">👤 Datos del Inquilino</h4>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="inquilino_name" class="form-label">
                                            Nombre Completo <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('inquilino.name') is-invalid @enderror" 
                                               id="inquilino_name" 
                                               name="inquilino[name]"
                                               value="{{ old('inquilino.name') }}"
                                               placeholder="Nombre y apellido"
                                               required>
                                        @error('inquilino.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="inquilino_email" class="form-label">
                                            Email <span class="required">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('inquilino.email') is-invalid @enderror" 
                                               id="inquilino_email" 
                                               name="inquilino[email]"
                                               value="{{ old('inquilino.email') }}"
                                               placeholder="correo@ejemplo.com"
                                               required>
                                        @error('inquilino.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="inquilino_phone" class="form-label">
                                            Teléfono <span class="required">*</span>
                                        </label>
                                        <input type="tel" 
                                               class="form-control @error('inquilino.phone') is-invalid @enderror" 
                                               id="inquilino_phone" 
                                               name="inquilino[phone]"
                                               value="{{ old('inquilino.phone') }}"
                                               placeholder="351 123 4567"
                                               required>
                                        @error('inquilino.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="inquilino_dni" class="form-label">
                                            DNI
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('inquilino.dni_number') is-invalid @enderror" 
                                               id="inquilino_dni" 
                                               name="inquilino[dni_number]"
                                               value="{{ old('inquilino.dni_number') }}"
                                               placeholder="12345678">
                                        @error('inquilino.dni_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- SECCIÓN 3: PROPIETARIO -->
                            <h4 class="section-title">🏡 Datos del Propietario</h4>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="propietario_name" class="form-label">
                                            Nombre Completo <span class="required">*</span>
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('propietario.name') is-invalid @enderror" 
                                               id="propietario_name" 
                                               name="propietario[name]"
                                               value="{{ old('propietario.name') }}"
                                               placeholder="Nombre y apellido"
                                               required>
                                        @error('propietario.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="propietario_email" class="form-label">
                                            Email <span class="required">*</span>
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('propietario.email') is-invalid @enderror" 
                                               id="propietario_email" 
                                               name="propietario[email]"
                                               value="{{ old('propietario.email') }}"
                                               placeholder="correo@ejemplo.com"
                                               required>
                                        @error('propietario.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="propietario_phone" class="form-label">
                                            Teléfono <span class="required">*</span>
                                        </label>
                                        <input type="tel" 
                                               class="form-control @error('propietario.phone') is-invalid @enderror" 
                                               id="propietario_phone" 
                                               name="propietario[phone]"
                                               value="{{ old('propietario.phone') }}"
                                               placeholder="351 123 4567"
                                               required>
                                        @error('propietario.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- SECCIÓN 4: GARANTE 1 (Opcional) -->
                            <h4 class="section-title">🤝 Garante 1 (Opcional)</h4>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="garante1_name" class="form-label">
                                            Nombre Completo
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('garante1.name') is-invalid @enderror" 
                                               id="garante1_name" 
                                               name="garante1[name]"
                                               value="{{ old('garante1.name') }}"
                                               placeholder="Nombre y apellido">
                                        @error('garante1.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="garante1_email" class="form-label">
                                            Email
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('garante1.email') is-invalid @enderror" 
                                               id="garante1_email" 
                                               name="garante1[email]"
                                               value="{{ old('garante1.email') }}"
                                               placeholder="correo@ejemplo.com">
                                        @error('garante1.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="garante1_phone" class="form-label">
                                            Teléfono
                                        </label>
                                        <input type="tel" 
                                               class="form-control @error('garante1.phone') is-invalid @enderror" 
                                               id="garante1_phone" 
                                               name="garante1[phone]"
                                               value="{{ old('garante1.phone') }}"
                                               placeholder="351 123 4567">
                                        @error('garante1.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- SECCIÓN 5: GARANTE 2 (Opcional) -->
                            <h4 class="section-title">🤝 Garante 2 (Opcional)</h4>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="garante2_name" class="form-label">
                                            Nombre Completo
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('garante2.name') is-invalid @enderror" 
                                               id="garante2_name" 
                                               name="garante2[name]"
                                               value="{{ old('garante2.name') }}"
                                               placeholder="Nombre y apellido">
                                        @error('garante2.name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="garante2_email" class="form-label">
                                            Email
                                        </label>
                                        <input type="email" 
                                               class="form-control @error('garante2.email') is-invalid @enderror" 
                                               id="garante2_email" 
                                               name="garante2[email]"
                                               value="{{ old('garante2.email') }}"
                                               placeholder="correo@ejemplo.com">
                                        @error('garante2.email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="garante2_phone" class="form-label">
                                            Teléfono
                                        </label>
                                        <input type="tel" 
                                               class="form-control @error('garante2.phone') is-invalid @enderror" 
                                               id="garante2_phone" 
                                               name="garante2[phone]"
                                               value="{{ old('garante2.phone') }}"
                                               placeholder="351 123 4567">
                                        @error('garante2.phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Botones -->
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    ✅ Continuar con Documentos
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <script>
        // Validación de fechas
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const endDateInput = document.getElementById('end_date');
            
            // Fecha fin debe ser posterior a fecha inicio
            const minEndDate = new Date(startDate);
            minEndDate.setDate(minEndDate.getDate() + 1);
            
            endDateInput.min = minEndDate.toISOString().split('T')[0];
        });
        
        // Auto-calcular fecha fin (2 años después por defecto)
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const endDate = new Date(startDate);
            endDate.setFullYear(endDate.getFullYear() + 2);
            
            document.getElementById('end_date').value = endDate.toISOString().split('T')[0];
        });
    </script>
</body>
</html>
</x-guest-layout>