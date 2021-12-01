/** inicio da modificação */
        if (Phone::where('user_id', $id)->first()) {
            $user->phone()->update([
                'user_id' => $id,
                'number' => $data['number'],
            ]);
        }else{
            $user->phone()->create($request->only('number'));
        }
        /** fim */
        /** inicio da modificação */
        if (Vehicle::where('user_id', $id)->first()) {
            // $user->vehicles()->update([
            //     'user_id' => $id,
            //     'type' => $data['vehicle']['type'],
            //     'plate' => $data['vehicle']['plate'],
            //     'color' => $data['vehicle']['color'],
            // ]);
        }else{
            // $user->vehicle()->create($request->only('type', 'plate', 'color'));
            foreach ($data['vehicle'] as $value) {

                $user->vehicles()->saveMany([
                    new Vehicle(['type' => $value['type'],
                                'plate' => $value['plate'],
                                'color' => $value['color']
                    ])
                ]);

            }

        }
        /** fim */
        /** inicio da modificação */
        // protected $fillable = ['user_id', 'nacionality', 'state', 'birth', 'cpf', 'rg', 'block', 'lot', 'house'];
        if (Complement::where('user_id', $id)->first()) {
            $user->complement()->update([
                'user_id' => $id,
                'nacionality' => $data['nacionality'],
                'state' => $data['state'],
                'birth' => $data['birth'],
                'cpf' => $data['cpf'],
                'rg' => $data['rg'],
                'block' => $data['block'],
                'lot' => $data['lot'],
                'house' => $data['house'],
            ]);
        }else{
            $user->complement()->create($request->only('user_id', 'nacionality', 'state', 'birth', 'cpf', 'rg', 'block', 'lot', 'house'));
        }
        /** fim */
        /** inicio da modificação */
        if (Relative::where('user_id', $id)->first()) {
            // $user->relative()->update([
            //     'user_id' => $id,
            //     'name_relative' => $data['name_relative'],
            //     'relationship' => $data['relationship'],
            // ]);
        }else{

            foreach ($data['relative'] as $value) {
                $user->relatives()->saveMany([
                    new Relative([
                        'name' => $value['name'],
                        'relationship' => $value['relationship']
                    ])
                ]);
            }
            //$user->relative()->create($request->only('name_relative','relationship'));
        }
        /** fim */
