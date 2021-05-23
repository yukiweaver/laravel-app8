export default {
    computed:{
        //
    },
    methods: {
        /**
         * スネークケースをキャメルケースにする
         * @param {string} p スネークケースの文字列（camel_case）
         * @return {string} キャメルケースの文字列（camelCase）
         */
        fSnakeToCamel: function(p) {
            //_+小文字を大文字にする(例:_a を A)
            return p.replace(/_./g,
                function(s) {
                    return s.charAt(1).toUpperCase();
                }
            );
        }
    }
}