@extends('layouts.app-master')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

<style>
:root {
    --primary-dark: #1A365D;
    --primary-light: #2EC4B6;
    --accent-yellow: #FFD166;
    --accent-orange: #FF6B35;
    --white: #FFFFFF;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
}

/* Nuevos estilos para el contenedor principal */
.content-container {
    min-height: 60vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 2rem 0;
}

.upload-container {
    max-width: 800px;
    width: 90%;
    margin: 0 auto;
    padding: 2.5rem;
    background-color: var(--white);
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    border: 2px solid var(--primary-dark);
}

.upload-title {
    font-size: 1.8rem;
    color: var(--primary-dark);
    margin-bottom: 1.8rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    text-align: center;
}

.upload-title i {
    color: var(--primary-light);
}

.upload-form {
    margin-top: 2rem;
}

.form-label {
    font-size: 1.3rem;
    color: var(--primary-dark);
    font-weight: 600;
    margin-bottom: 0.8rem;
    display: block;
}

.form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    font-size: 1.3rem;
    border: 2px solid var(--primary-dark);
    border-radius: 6px;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--primary-light);
    box-shadow: 0 0 0 3px rgba(46, 196, 182, 0.3);
    outline: none;
}

.submit-btn {
    background-color: var(--primary-dark);
    color: var(--white);
    border: none;
    border-radius: 6px;
    padding: 0.8rem 1.5rem;
    font-size: 1.3rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    width: 25%;
    justify-content: center;
    margin-bottom: 1.5rem;
}

.submit-btn:hover {
    background-color: #122a4a;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.file-input-wrapper {
    position: relative;
    overflow: hidden;
    display: inline-block;
    width: 100%;
}

.file-input-wrapper input[type="file"] {
    font-size: 1.3rem;
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-input-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.8rem 1rem;
    background-color: var(--light-gray);
    border: 2px dashed var(--primary-dark);
    border-radius: 6px;
    font-size: 1.3rem;
    color: var(--primary-dark);
    cursor: pointer;
    transition: all 0.3s ease;
}

.file-input-label:hover {
    background-color: var(--medium-gray);
}

.file-input-icon {
    color: var(--primary-light);
    font-size: 1.5rem;
}

/* Botón de regresar - ahora debajo del botón principal */
.back-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    background-color: #FF6B35;
    color: var(--white);
    border: none;
    border-radius: 6px;
    font-size: 1.3rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    width: 20%;
}

.back-btn:hover {
    background-color: #d95a2c;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    color: var(--white);
}

.button-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .content-container {
        padding: 1.5rem 0;
    }
    
    .upload-container {
        padding: 1.8rem;
    }
    
    .upload-title {
        font-size: 1.6rem;
    }
}

@media (max-width: 480px) {
    .content-container {
        padding: 1rem 0;
    }
    
    .upload-title {
        font-size: 1.4rem;
    }
    
    .form-label,
    .form-control,
    .submit-btn,
    .back-btn {
        font-size: 1.2rem;
    }
}
</style>

<div class="content-container">
    <div class="upload-container">
        <h2 class="upload-title">
            <i class="fas fa-file-upload"></i> Subir Comprobante de Pago
        </h2>

        <form action="{{ route('user.payments.store') }}" method="POST" enctype="multipart/form-data" class="upload-form">
            @csrf

            <input type="hidden" name="membership_id" value="{{ $membership->id }}">
            <input type="hidden" name="price" value="{{ $membership->price }}">

            <div class="mb-4">
                <label for="receipt" class="form-label">Comprobante de pago (PDF, JPG, PNG)</label>
                <div class="file-input-wrapper">
                    <label class="file-input-label" for="receipt">
                        <span id="file-name">Seleccionar archivo...</span>
                        <i class="fas fa-paperclip file-input-icon"></i>
                    </label>
                    <input type="file" id="receipt" class="form-control" name="receipt" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i> Enviar comprobante
                </button>
                <!-- Botón de regresar ahora debajo del botón principal -->
                <a href="{{ route('user.memberships.pay', $membership->id) }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('receipt').addEventListener('change', function(e) {
    const fileName = e.target.files[0] ? e.target.files[0].name : 'Seleccionar archivo...';
    document.getElementById('file-name').textContent = fileName;
});
</script>
@endsection