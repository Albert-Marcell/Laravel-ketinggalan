<x-layout title="Detail">


    <div>
        <h1>Detail Fakultas</h1>


        <table class="table">
            <tbody>
                <tr>
                    <td>Nama Fakultas</td>
                    <td>:</td>
                    <td>{{ $fakulta -> name}}</td>
                </tr>
                <tr>
                    <td>Nama Dekan</td>
                    <td>:</td>
                    <td>{{ $fakulta -> dekan }}</td>
                </tr>

            </tbody>
        </table>
    </div>
</x-layout>