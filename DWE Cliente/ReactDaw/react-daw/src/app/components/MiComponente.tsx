import React from 'react'

// con Next snippets escribimos 'rafc'
export const MiComponente = () => {
  return (
    <div>

        <h2>MiComponente</h2>
        <input placeholder='Introduce tu nombre' />
        <input placeholder='Introduce tu apellido' />
        <input placeholder='Introduce tu telefono' inputMode='numeric'/>
        <button>Enviar datos</button>

    </div>
  )
}
