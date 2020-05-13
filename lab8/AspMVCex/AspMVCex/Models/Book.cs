﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace AspMVCex.Models
{
    public class Book
    {
        public int id { get; set; }
        public string author { get; set; }
        public string title { get; set; }
        public string publisher { get; set; }
        public int borrowerId { get; set; }
        public string genre { get; set; }

    }
}