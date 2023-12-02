<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Paciente;
use App\Models\Clinico;
use App\Models\Examen;
use App\Models\Propietario;

class DBVeterinariaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRelacionPacientePropietario()
    {
        $propietario = Propietario::factory()->create();
        $paciente = Paciente::factory()->make();
        $propietario->pacientes()->save($paciente);

        $this->assertDatabaseHas('pacientes', ['propietario_id' => $propietario->id]);
    }

    public function testRelacionClinicoExamen()
    {
        $clinico = Clinico::factory()->create();
        $examen = Examen::factory()->make();
        $clinico->examenes()->save($examen);

        $this->assertDatabaseHas('examenes', ['clinico_id' => $clinico->id]);
    }

    public function testRelacionPacienteExamen()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->make();
        $paciente->examenes()->save($examen);

        $this->assertDatabaseHas('examenes', ['paciente_id' => $paciente->id]);
    }

    public function testRelacionPropietarioClinico()
    {
        $propietario = Propietario::factory()->create();
        $clinico = Clinico::factory()->make();
        $propietario->clinicos()->save($clinico);

        $this->assertDatabaseHas('clinicos', ['propietario_id' => $propietario->id]);
    }

    public function testCreacionClinicoConPacienteAsociado()
    {
        $paciente = Paciente::factory()->create();
        $clinico = Clinico::factory()->make(['num_id' => $paciente->id]);
        $this->assertDatabaseHas('clinicos', ['num_id' => $paciente->id]);
    }

    public function testCreacionExamenConPacienteAsociado()
    {
        $paciente = Paciente::factory()->create();
        $examen = Examen::factory()->make(['num_id' => $paciente->id]);
        $this->assertDatabaseHas('examens', ['num_id' => $paciente->id]);
    }

    public function testBorradoPacienteConClinicoAsociado()
    {
        $paciente = Paciente::factory()->has(Clinico::factory()->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->delete();
    }

    public function testBorradoPacienteConExamenAsociado()
    {
        $paciente = Paciente::factory()->has(Examen::factory()->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->delete();
    }

    public function testCreacionPacienteConPropietarioAsociado()
    {
        $propietario = Propietario::factory()->create();
        $paciente = Paciente::factory()->make(['pro_id' => $propietario->id]);
        $this->assertDatabaseHas('pacientes', ['pro_id' => $propietario->id]);
    }

    public function testBorradoPropietarioConPacienteAsociado()
    {
        $propietario = Propietario::factory()->has(Paciente::factory()->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->delete();
    }

    public function testCreacionClinicoSinSintomas()
    {
        $clinico = Clinico::factory()->make(['sintomas' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenSinTemperatura()
    {
        $examen = Examen::factory()->make(['temperatura' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteSinNombreMascota()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['nombre_mascota' => null]);
    }

    public function testActualizacionPropietarioSinNombre()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['nombre' => null]);
    }

    public function testCreacionClinicoConEnfermedadEspecial()
    {
        $clinico = Clinico::factory()->make(['enfermedad' => '@#$%^&*']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConPesoNegativo()
    {
        $examen = Examen::factory()->make(['peso' => -1]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConRazaEspecial()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['raza' => '@#$%^&*']);
    }

    public function testActualizacionPropietarioConDireccionEspecial()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['direccion' => '@#$%^&*']);
    }

    public function testCreacionClinicoConTratamientoLargo()
    {
        $clinico = Clinico::factory()->make(['tratamiento' => str_repeat('a', 256)]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConFrecuenciaCardiacaAlta()
    {
        $examen = Examen::factory()->make(['frecuencia_cardiaca' => 1001]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConNombreMascotaLargo()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['nombre_mascota' => str_repeat('a', 256)]);
    }

    public function testActualizacionPropietarioConCorreoInvalido()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['correo' => 'correo_invalido']);
    }

    public function testCreacionClinicoConNumIdInexistente()
    {
        $clinico = Clinico::factory()->make(['num_id' => 9999]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConNumIdInexistente()
    {
        $examen = Examen::factory()->make(['num_id' => 9999]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConGeneroIdInexistente()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['genero_id' => 9999]);
    }

    public function testActualizacionPropietarioConGeneIdInexistente()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['gene_id' => 9999]);
    }

    public function testCreacionClinicoConFechaFutura()
    {
        $clinico = Clinico::factory()->make(['fecha' => now()->addYear()]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConFechaFutura()
    {
        $examen = Examen::factory()->make(['fecha' => now()->addYear()]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConFechaNacimientoFutura()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['fecha_nacimiento' => now()->addYear()]);
    }

    public function testActualizacionPropietarioConFechaNacimientoFutura()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['fecha_nacimiento' => now()->addYear()]);
    }

    public function testCreacionClinicoConDiagnosticoVacio()
    {
        $clinico = Clinico::factory()->make(['diagnostico' => '']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConResultadoVacio()
    {
        $examen = Examen::factory()->make(['resultado' => '']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConColorVacio()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['color' => '']);
    }

    public function testActualizacionPropietarioConTelefonoVacio()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['telefono' => '']);
    }

    public function testCreacionClinicoConPrescripcionNumerica()
    {
        $clinico = Clinico::factory()->make(['prescripcion' => 12345]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConObservacionesNumericas()
    {
        $examen = Examen::factory()->make(['observaciones' => 12345]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConEspecieNumerica()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['especie' => 12345]);
    }

    public function testActualizacionPropietarioConApellidoNumerico()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['apellido' => 12345]);
    }

    public function testCreacionClinicoConPrescripcionNull()
    {
        $clinico = Clinico::factory()->make(['prescripcion' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConObservacionesNull()
    {
        $examen = Examen::factory()->make(['observaciones' => null]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConEspecieNull()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['especie' => null]);
    }

    public function testActualizacionPropietarioConApellidoNull()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['apellido' => null]);
    }

    public function testCreacionClinicoConPrescripcionMuyLarga()
    {
        $clinico = Clinico::factory()->make(['prescripcion' => str_repeat('a', 1001)]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConObservacionesMuyLargas()
    {
        $examen = Examen::factory()->make(['observaciones' => str_repeat('a', 1001)]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConEspecieMuyLarga()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['especie' => str_repeat('a', 256)]);
    }

    public function testActualizacionPropietarioConApellidoMuyLargo()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['apellido' => str_repeat('a', 256)]);
    }

    public function testCreacionClinicoConPrescripcionCaracteresEspeciales()
    {
        $clinico = Clinico::factory()->make(['prescripcion' => '@#$%^&*']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConObservacionesCaracteresEspeciales()
    {
        $examen = Examen::factory()->make(['observaciones' => '@#$%^&*']);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testActualizacionPacienteConEspecieCaracteresEspeciales()
    {
        $paciente = Paciente::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->update(['especie' => '@#$%^&*']);
    }

    public function testActualizacionPropietarioConApellidoCaracteresEspeciales()
    {
        $propietario = Propietario::factory()->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->update(['apellido' => '@#$%^&*']);
    }

    public function testCreacionClinicoConPropietarioInexistente()
    {
        $clinico = Clinico::factory()->make(['propietario_id' => 9999]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->save();
    }

    public function testCreacionExamenConPacienteInexistente()
    {
        $examen = Examen::factory()->make(['num_id' => 9999]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen->save();
    }

    public function testBorradoPropietarioConClinicoAsociado()
    {
        $propietario = Propietario::factory()->has(Clinico::factory()->count(3))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $propietario->delete();
    }

    public function testCreacionClinicoConPacienteDuplicado()
    {
        $paciente = Paciente::factory()->create();
        $clinico1 = Clinico::factory()->make(['paciente_id' => $paciente->id]);
        $clinico1->save();
        $clinico2 = Clinico::factory()->make(['paciente_id' => $paciente->id]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico2->save();
    }

    public function testCreacionExamenConClinicoDuplicado()
    {
        $clinico = Clinico::factory()->create();
        $examen1 = Examen::factory()->make(['clinico_id' => $clinico->id]);
        $examen1->save();
        $examen2 = Examen::factory()->make(['clinico_id' => $clinico->id]);
        $this->expectException(\Illuminate\Database\QueryException::class);
        $examen2->save();
    }

    public function testBorradoPacienteConClinicoDuplicado()
    {
        $paciente = Paciente::factory()->has(Clinico::factory()->count(2))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $paciente->delete();
    }

    public function testBorradoClinicoConExamenDuplicado()
    {
        $clinico = Clinico::factory()->has(Examen::factory()->count(2))->create();
        $this->expectException(\Illuminate\Database\QueryException::class);
        $clinico->delete();
    }
}