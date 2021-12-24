import Axios from "axios";

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
        },

        /**
         * カテゴリーの名前を返す
         * @param {array} categories
         * @param {int} categoryId 
         * @returns {string}
         */
         getCategoryNameById: function(categories, categoryId) {
            let categoryName = '';
            for(let category of categories) {
                if (category.id == categoryId) {
                    categoryName = category.name;
                    break;
                }
            }

            return categoryName;
        },

        /**
         * オブジェクトが空であるか判定する
         * @param {Object} obj 
         * @returns {boolean}
         */
        isEmptyObject(obj) {
            return !Object.keys(obj).length;
        },

        /**
         * GETでリクエスト
         * @param {string} url 
         * @param {object} params 
         * @returns 
         */
        async requestGet(url, params) {
            return await axios.get(url, {
                params: params
            });
        }
    }
}