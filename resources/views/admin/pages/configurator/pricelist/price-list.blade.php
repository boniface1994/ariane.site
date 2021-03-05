@extends('layouts.admin')

@section('content')
<h3 class="card-title">
            {{ __('Gestion price list') }}
</h3>
<div class="card card-custom ">
    <div class="card-header card-header-tabs-line">
        <div class="card-toolbar">
            <ul class="nav nav-tabs  nav-tabs-line" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#cubsat">
                        <h5 class="card-label">{{ __('Price list for cubsat') }}</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#smallsat">
                        <h5 class="card-label">{{ __('Price list for smallsat') }}</h5>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body pricelists">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="cubsat" role="tabpanel" aria-labelledby="cubsat">
                <form class="form" action="{{ route('pricelist.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{ __('1U') }}</th>
                                    <th scope="col">{{ __('2U') }}</th>
                                    <th scope="col">{{ __('3U') }}</th>
                                    <th scope="col">{{ __('6U') }}</th>
                                    <th scope="col">{{ __('12U') }}</th>
                                    <th scope="col">{{ __('16U') }}</th>
                                    <th scope="col">{{ __('24U') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __('LEO Price') }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_1u" value="{{ isset($pricelists['leo_1u']) ? $pricelists['leo_1u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_2u" value="{{ isset($pricelists['leo_2u']) ? $pricelists['leo_2u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_3u" value="{{ isset($pricelists['leo_3u']) ? $pricelists['leo_3u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_6u" value="{{ isset($pricelists['leo_6u']) ? $pricelists['leo_6u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_12u" value="{{ isset($pricelists['leo_12u']) ? $pricelists['leo_12u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_16u" value="{{ isset($pricelists['leo_16u']) ? $pricelists['leo_16u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_24u" value="{{ isset($pricelists['leo_24u']) ? $pricelists['leo_24u'] : '' }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('GTO Price') }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_1u" value="{{ isset($pricelists['gto_1u']) ? $pricelists['gto_1u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_2u" value="{{ isset($pricelists['gto_2u']) ? $pricelists['gto_2u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_3u" value="{{ isset($pricelists['gto_3u']) ? $pricelists['gto_3u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_6u" value="{{ isset($pricelists['gto_6u']) ? $pricelists['gto_6u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_12u" value="{{ isset($pricelists['gto_12u']) ? $pricelists['gto_12u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_16u" value="{{ isset($pricelists['gto_16u']) ? $pricelists['gto_16u'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_24u" value="{{ isset($pricelists['gto_24u']) ? $pricelists['gto_24u'] : '' }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="">
                            <p>{{ __('L\'indication LEO ou GTO est paramétrable par le back-office à l\'endroit ou on gère les types d\'orbites.') }}</p>
                            <p>{{ __('Le prix indiqué dans le configurateur = prix fixe en fonction du nombre d\'unités') }}</p>
                        </label>
                    </div>

                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
            <div class="tab-pane fade" id="smallsat" role="tabpanel" aria-labelledby="smallsat">
                <form class="form" action="{{ route('pricelist.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <table class="table table-bordered">
                        <thead>
                                <tr>
                                    <th scope="col">{{ __('Mass bearings') }}</th>
                                    <th scope="col">{{ __('P1') }}</th>
                                    <th scope="col">{{ __('P2') }}</th>
                                    <th scope="col">{{ __('P3') }}</th>
                                    <th scope="col">{{ __('P4') }}</th>
                                    <th scope="col">{{ __('P5') }}</th>
                                    <th scope="col">{{ __('P6') }}</th>
                                    <th scope="col">{{ __('P7') }}</th>
                                    <th scope="col">{{ __('P8') }}</th>
                                    <th scope="col">{{ __('P9') }}</th>
                                    <th scope="col">{{ __('P10') }}</th>
                                    <th scope="col">{{ __('P11') }}</th>
                                    <th scope="col">{{ __('P12') }}</th>
                                    <th scope="col">{{ __('P13') }}</th>
                                    <th scope="col">{{ __('P14') }}</th>
                                    <th scope="col">{{ __('P15') }}</th>
                                    <th scope="col">{{ __('P16') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ __('Price per kg LEO') }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p1" value="{{ isset($pricelists['leo_p1']) ? $pricelists['leo_p1'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p2" value="{{ isset($pricelists['leo_p2']) ? $pricelists['leo_p2'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p3" value="{{ isset($pricelists['leo_p3']) ? $pricelists['leo_p3'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p4" value="{{ isset($pricelists['leo_p4']) ? $pricelists['leo_p4'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p5" value="{{ isset($pricelists['leo_p5']) ? $pricelists['leo_p5'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p6" value="{{ isset($pricelists['leo_p6']) ? $pricelists['leo_p6'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p7" value="{{ isset($pricelists['leo_p7']) ? $pricelists['leo_p7'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p8" value="{{ isset($pricelists['leo_p8']) ? $pricelists['leo_p8'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p9" value="{{ isset($pricelists['leo_p9']) ? $pricelists['leo_p9'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p10" value="{{ isset($pricelists['leo_p10']) ? $pricelists['leo_p10'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p11" value="{{ isset($pricelists['leo_p11']) ? $pricelists['leo_p11'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p12" value="{{ isset($pricelists['leo_p12']) ? $pricelists['leo_p12'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p13" value="{{ isset($pricelists['leo_p13']) ? $pricelists['leo_p13'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p14" value="{{ isset($pricelists['leo_p14']) ? $pricelists['leo_p14'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p15" value="{{ isset($pricelists['leo_p15']) ? $pricelists['leo_p15'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="leo_p16" value="{{ isset($pricelists['leo_p16']) ? $pricelists['leo_p16'] : '' }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ __('Price per kg GTO') }}</td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p1" value="{{ isset($pricelists['gto_p1']) ? $pricelists['gto_p1'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p2" value="{{ isset($pricelists['gto_p2']) ? $pricelists['gto_p2'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p3" value="{{ isset($pricelists['gto_p3']) ? $pricelists['gto_p3'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p4" value="{{ isset($pricelists['gto_p4']) ? $pricelists['gto_p4'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p5" value="{{ isset($pricelists['gto_p5']) ? $pricelists['gto_p5'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p6" value="{{ isset($pricelists['gto_p6']) ? $pricelists['gto_p6'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p7" value="{{ isset($pricelists['gto_p7']) ? $pricelists['gto_p7'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p8" value="{{ isset($pricelists['gto_p8']) ? $pricelists['gto_p8'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p9" value="{{ isset($pricelists['gto_p9']) ? $pricelists['gto_p9'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p10" value="{{ isset($pricelists['gto_p10']) ? $pricelists['gto_p10'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p11" value="{{ isset($pricelists['gto_p11']) ? $pricelists['gto_p11'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p12" value="{{ isset($pricelists['gto_p12']) ? $pricelists['gto_p12'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p13" value="{{ isset($pricelists['gto_p13']) ? $pricelists['gto_p13'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p14" value="{{ isset($pricelists['gto_p14']) ? $pricelists['gto_p14'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p15" value="{{ isset($pricelists['gto_p15']) ? $pricelists['gto_p15'] : '' }}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="gto_p16" value="{{ isset($pricelists['gto_p16']) ? $pricelists['gto_p16'] : '' }}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('On peut indiquer jusqu\'à 16 paliers. Si Arianespace n\'a pas besoin de 10 paliers, il suffit de laisser vide  les paliers non utilisés (ils ne seront tout simplement pas pris en compte).
                            Le palier 1 commence à 0.
                            Pour éditer les paliers, il suffit de cliquer sur la cellule du palier et de modifier la valeur.
                            Un palier de masse est un nombre entier.
                            Le prix indiqué dans le configurateur = prix au kg correspondant à la borne inférieur du palier de masse (sur la base du nbre de kg indiqué par le client) x le nbre de kg du satellite indiqué dans le configurateur par le client.') }}
                        </label>
                    </div>
                    <button type="submit" class="validate-option btn btn-success font-weight-bold mr-2">
                        <i class="la la-check"></i> {{ __('Validate') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.pricelists').find('form').each(function(i,element){
            $(element).find('button[type="submit"]').on('click',function(e){
                e.preventDefault();
                let form = $(this).closest('form');
                let url = form.attr('action');
                let method = form.attr('method');
                $.ajax({
                    url: url,
                    method: method,
                    data : form.serialize(),
                    success: function(response){
                        toastr.success("Success !");
                    }
                })
            });
        })

    });
</script>
@endsection